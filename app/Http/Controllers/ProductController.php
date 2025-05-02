<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::get();
        return view('admin.add-products',compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate each image
        ]);
    
        // Store product details in the 'products' table
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'cat_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
        ]);
    
        // Handle multiple image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // Generate a unique filename
                $filename = uniqid() . '.' . $file->getClientOriginalExtension(); 
    
                // Store file in 'product_images' directory
                $file->storeAs('product_images', $filename, 'public');
    
                // Store only the filename in the database
                Media::create([
                    'product_id' => $product->id,
                    'image' => $filename // Storing only the filename
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Product created successfully!');
    }
    public function view()
    {
        $products=Product::all();
        return view('admin.list-products',compact('products'));
    }
    public function edit($id)
    {
        $product = Product::with('images')->find($id);
        $categories = Category::all(); 

    return view('admin.edit-products', compact('product', 'categories'));

    }
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'nullable|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $product = Product::findOrFail($id);
    $product->update([
        'title' => $request->title,
        'description' => $request->description,
        'cat_id' => $request->category_id,
        'price' => $request->price,
        'stock' => $request->stock,
        'status' => $request->status,
    ]);

    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension(); 
    
            // Store file in 'product_images' directory
            $file->storeAs('product_images', $filename, 'public');

            Media::create([
                'product_id' => $product->id,
                'image' => $filename
            ]);
        }
    }

    return redirect()->back()->with('success', 'Product updated successfully!');
}
public function deleteImage(Request $request)
{
    $image = Media::findOrFail($request->image_id);
    Storage::delete('public/product_images/' . $image->image);
    $image->delete();

    return response()->json(['success' => true]);
}
public function deleteProduct($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('admin.view.products')->with('error', 'Product not found.');
    }

    foreach ($product->images as $image) {
        Storage::delete('public/product_images/' . $image->image);
        $image->delete();
    }

   $product->delete();

    return redirect()->route('admin.view.products')->with('success', 'Product deleted successfully.');
}


}
