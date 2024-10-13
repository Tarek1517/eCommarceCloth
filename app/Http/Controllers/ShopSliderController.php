<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\ShopSlides;

class ShopSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['shopSlidesContents'] = ShopSlides::orderBy('created_at', 'DESC')->get();
        return view('pages.shopslider.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.shopslider.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string',
            'btitle' => 'required|string',
            'description' => 'required|string',
            'status' => 'required',
            'image' => 'required',
        ]);

        $data = [];

        $data['title'] = $request->title;
        $data['btitle'] = $request->btitle;
        $data['description'] = $request->description;
        $data['status'] = $request->status;


        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $data['image'] = $image_full_name;

        }

        $insertData = ShopSlides::create($data);

        if ($insertData) {

            return redirect()->route('add.shop.slides')->with('success', 'Shop slides has been save successfully');

        } else {

            return redirect()->route('add.shop.slides')->with('error', 'Failed to save Shop slides');

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

        $data['editShopSlides'] = ShopSlides::find($id);

        return view('pages.shopslider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'title' => 'required|string',
            'btitle' => 'required|string',
            'description' => 'required|string',
            'status' => 'required',
        ]);

        $data = [];

        $data['title'] = $request->title;
        $data['btitle'] = $request->btitle;
        $data['description'] = $request->description;
        $data['status'] = $request->status;


        if ($request->file('image')) {

            $shopSlide = ShopSlides::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $shopSlide->image);

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

        $insertData = ShopSlides::where('id', $id)->update($data);

        if ($insertData) {

            return redirect()->route('shop.slides.list')->with('success', 'Shop slides has been update successfully');

        } else {

            return redirect()->route('shop.slides.list')->with('error', 'Failed to update Shop slides');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shopSlide = ShopSlides::findOrFail($id);

        $image_path = storage_path('app/public/img/' . $shopSlide->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $shopSlide->delete();

        return redirect()->route('shop.slides.list')->with('success', 'shop slides Delete Successfully');
    }

    public function inactiveShSlides($id)
    {

        ShopSlides::where('id', $id)->update(['status' => 'inactive']);

        return redirect()->route('shop.slides.list');

    }

    public function activeShSlides($id)
    {
        ShopSlides::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('shop.slides.list');

    }
}
