<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $this->processImage($request->file('image'));
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imageName,
            'created_at' => now(),
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0.01',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            $imageName = $this->processImage($request->file('image'));

            if ($product->image) {
                $oldPath = public_path('uploads/products/' . $product->image);

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => $imageName,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->sales()->exists()) {
            return redirect()->route('products.index')
                ->with('error', 'This product has sales records and cannot be deleted.');
        }

        if ($product->image) {
            $path = public_path('uploads/products/' . $product->image);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    private function processImage($file)
    {
        $directory = public_path('uploads/products');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $imageName = Str::uuid() . '.' . $extension;

        $source = match ($extension) {
            'jpg', 'jpeg' => imagecreatefromjpeg($file->getPathname()),
            'png' => imagecreatefrompng($file->getPathname()),
            default => throw new \InvalidArgumentException('Unsupported image type'),
        };

        if (!$source) {
            throw new \RuntimeException('Unable to read uploaded image.');
        }

        $width = imagesx($source);
        $height = imagesy($source);

        $size = min($width, $height);

        $x = ($width - $size) / 2;
        $y = ($height - $size) / 2;

        $target = imagecreatetruecolor(300, 300);

        if ($extension === 'png') {
            imagealphablending($target, false);
            imagesavealpha($target, true);

            $transparent = imagecolorallocatealpha($target, 0, 0, 0, 127);
            imagefill($target, 0, 0, $transparent);
        }

        imagecopyresampled($target, $source, 0, 0, (int) $x, (int) $y, 300, 300, $size, $size);

        $destination = $directory . '/' . $imageName;

        if ($extension === 'png') {
            imagepng($target, $destination);
        } else {
            imagejpeg($target, $destination, 85);
        }

        imagedestroy($source);
        imagedestroy($target);

        return $imageName;
    }
}
