<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['CategoryContents'] = Category::orderBy('created_at','DESC')->get();
        return view('pages.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:categories',
            'image' => 'required',

        ]);

        $data = [];

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;

        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $data['image'] = $image_full_name;

        }

        $insertData = Category::create($data);

        if ($insertData) {

            return redirect()->route('add.category')->with('success', 'Category has been save successfully');

        } else {

            return redirect()->route('add.category')->with('error', 'Failed to save Category');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];

        $data['editCategory'] = Category::find($id);

        return view('pages.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:brands,slug,' . $id,
            
            

        ]);

        $data = [];

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;

        if ($request->file('image')) {

            $Category = Category::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $Category->image);

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $data['image'] = $image_full_name;

        }

        $insertData = Category::where('id',$id)->update($data);


        if ($insertData) {

            return redirect()->route('category.list')->with('success', 'Category has been update successfully');

        } else {

            return redirect()->route('category.list')->with('error', 'Failed to update Category');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $category = Category::findOrFail($id);

        if ($category->product()->exists()) {
            return redirect()->route('category.list')->with('error', 'Category cannot be deleted because it is associated with products.You Can update it !');
        }

        $image_path = storage_path('app/public/img/' . $category->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $category->delete();
        return redirect()->route('category.list')->with('success', 'Category Delete Successfully');
    }
}
