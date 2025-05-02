<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
    $categories = Category::with('parent')->get();
     return view('admin.list-category',compact('categories'));
    }
    public function create()
    {
        $categories=Category::get();
        return view('admin.add-category',compact('categories'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $input['title'] = $request->post('title');
        $input['parentcategory'] = $request->post('category_id');
    
      if ($request->hasFile('image')) {
            $extension = $request->image->extension();
            $filename = Str::random(6) . "_" . time() . "_gallery." . $extension;
            $request->image->storeAs('images', $filename);
            $input['image'] = $filename; 
        }
        Category::create($input);
    
        return redirect()->route('admin.create.category')->with('success', 'Category created successfully!');
    }
    public function edit($catId)
    {
        $categories=Category::get();
        $edit=Category::find($catId);
        return view('admin.edit-category',compact('categories','edit'));
    }
    public function update(Request $request, $id)
 {
   $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Category not found.');
    }

    $category->title = $request->title;
    $category->parentcategory = $request->category_id;

    if ($request->hasFile('image')) {
        
        if (!empty($category->image) && Storage::exists('images/' . $category->image)) {
            Storage::delete('images/' . $category->image);
        }

        $extension = $request->image->getClientOriginalExtension();
        $filename = Str::random(6) . "_" . time() . "_gallery." . $extension;
        $request->image->storeAs('images', $filename, 'public');
        $category->image = $filename;
    }
    $category->save();

    return redirect()->route('admin.category.list')->with('success', 'Category updated successfully!');
}

       public function delete($catId)
    {
       
    $category = Category::find($catId);
      if ($category->image) {
        Storage::delete('images/' . $category->image);
    }
    $category->delete();

    return redirect()->back()->with('success', 'Category and image deleted successfully!');
    }

}
