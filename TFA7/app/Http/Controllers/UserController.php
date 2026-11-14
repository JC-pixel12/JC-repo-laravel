<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','asc')->get();

        return view('users', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100'
        ]);

        $validated['created_at'] = Carbon::now();

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username'  => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user->username = $validated['username'];
        $user->full_name = $validated['full_name'];

        if ($request->hasFile('avatar')) {
            $avatarName = $this->prepareAvatar($request->file('avatar'));

            if ($user->avatar){
                $oldPath = public_path(
                    'uploads/avatars/'.$user->avatar
                );

                if (File::exists($oldPath)){
                    File::delete($oldPath);
                }
            }

            $user->avatar = $avatarName;
        }

        $user->save();
        
        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    private function prepareAvatar($file)
    {
        $imageType = $file->getMimeType();

        if ($imageType === 'image/jpeg') {
            $source = imagecreatefromjpeg($file->getRealPath());
            $extension = 'jpg';
        } 
        elseif ($imageType === 'image/png') {
            $source = imagecreatefrompng($file->getRealPath());
            $extension = 'png';
        } 
        else {
            throw new \RuntimeException('Unsupported image format.');
        }

        if (!$source) {
            throw new \RuntimeException('Unable to process uploaded image.');
        }

        $width = imagesx($source);
        $height = imagesy($source);

        $size = min($width, $height);
        $sourceX = (int) (($width - $size) / 2);
        $sourceY = (int) (($height - $size) / 2);

        $thumbnail = imagecreatetruecolor(300, 300);

        if ($extension === 'png') {
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);

            $transparent = imagecolorallocatealpha(
                $thumbnail, 255, 255, 255, 127
            );

            imagefill($thumbnail, 0, 0, $transparent);
        }

        imagecopyresampled(
            $thumbnail,
            $source,
            0, 0,
            $sourceX, $sourceY,
            300, 300,
            $size, $size
        );

        $directory = public_path('uploads/avatars');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::uuid() . '.' . $extension;
        $destination = $directory . '/' . $filename;

        if ($extension === 'jpg') {
            imagejpeg($thumbnail, $destination, 85);
        } else {
            imagepng($thumbnail, $destination, 6);
        }

        imagedestroy($source);
        imagedestroy($thumbnail);

        return $filename;
    }
}
