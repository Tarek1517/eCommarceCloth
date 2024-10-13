<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['brandContents'] = Brand::orderBy('created_at', 'DESC')->get();
        return view('pages.brand.index', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:brands',
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

        $insertData = Brand::create($data);

        if ($insertData) {

            return redirect()->route('add.brand')->with('success', 'Brand has been save successfully');

        } else {

            return redirect()->route('add.brand')->with('error', 'Failed to save Brand');

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

        $data['editBrand'] = Brand::find($id);

        return view('pages.brand.edit', $data);
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

            $Brand = Brand::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $Brand->image);

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

        $insertData = Brand::where('id', $id)->update($data);

        if ($insertData) {

            return redirect()->route('brand.list')->with('success', 'Brand has been update successfully');

        } else {

            return redirect()->route('brand.list')->with('error', 'Failed to update Brand');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $brand = Brand::findOrFail($id);

        if ($brand->product()->exists()) {
            return redirect()->route('brand.list')->with('error', 'Brand cannot be deleted because it is associated with products.You Can update it !');
        }

        $image_path = storage_path('app/public/img/' . $brand->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $brand->delete();

        return redirect()->route('brand.list')->with('success', 'Brand Deleted Successfully');
    }

}
