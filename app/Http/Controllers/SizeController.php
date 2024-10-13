<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['sizeContents'] = Size::orderBy('created_at','DESC')->get();
        return view('pages.size.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.size.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:sizes',
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

        $insertData = Size::create($data);

        if ($insertData) {

            return redirect()->route('add.size')->with('success', 'Category has been save successfully');

        } else {

            return redirect()->route('add.size')->with('error', 'Failed to save Category');

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

        $data['editSize'] = Size::find($id);

        return view('pages.size.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:sizes,slug,' . $id,

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

        $insertData = Size::where('id',$id)->update($data);


        if ($insertData) {

            return redirect()->route('size.list')->with('success', 'size has been update successfully');

        } else {

            return redirect()->route('size.list')->with('error', 'Failed to update size');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::findOrFail($id);

        if ($size->product()->exists()) {
            return redirect()->route('size.list')->with('error', 'size cannot be deleted because it is associated with products.You Can update it !');
        }

        $image_path = storage_path('app/public/img/' . $size->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $size->delete();
        return redirect()->route('size.list')->with('success', 'Brand Delete Successfully');
    }
}
