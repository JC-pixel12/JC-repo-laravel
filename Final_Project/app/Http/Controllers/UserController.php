<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','asc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $avatarName = null;

        if ($request->hasFile('avatar')) {
        $avatarName = $this->prepareAvatar(
            $request->file('avatar')
        );
    }

        User::create([
            'username' => $validated['username'],
            'full_name' => $validated['full_name'],
            'password' => password_hash($validated['password'],PASSWORD_DEFAULT),
            'created_at' => Carbon::now(),
            'avatar' => $avatarName
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully!');
    }

    public function show(User $user)
    {

        return view('users.show', compact('user'));
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
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'full_name' => 'required|string|max:100',
            'password' => 'nullable|string|min:8',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'username' => $validated['username'],
            'full_name' => $validated['full_name'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }


        $oldAvatar = $user->avatar;
        $newAvatar = null;

        if ($request->hasFile('avatar')) {
            $avatarName = $this->prepareAvatar($request->file('avatar'));

            $data['avatar'] = $newAvatar;
        }

        $user->update($data);
        
        if ($newAvatar && $oldAvatar) {
            $oldPath = public_path('uploads/avatars/' . $oldAvatar);

            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

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

    public function destroy(User $user)
    {
        if ($user->sales()->exists()) {
            return redirect()->route('users.index')
                ->with('error', 'This staff member has sales records and cannot be deleted.');
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own logged-in account.');
        }

        if ($user->avatar) {
            $path = public_path('uploads/avatars/' . $user->avatar);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Staff member deleted successfully.');
    }
}
