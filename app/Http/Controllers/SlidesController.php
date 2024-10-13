<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\Slides;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['SlidesContents'] = Slides::orderBy('created_at', 'DESC')->get();
        return view('pages.slides.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.slides.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'tagline' => 'required | string',
            'title' => 'required | string',
            'subtitle' => 'required | string',
            'link' => 'required | string',
            'status' => 'required',
            'image' => 'required',

        ]);

        $data = [];

        $data['tagline'] = $request->tagline;
        $data['title'] = $request->title;
        $data['subtitle'] = $request->subtitle;
        $data['link'] = $request->link;
        $data['status'] = $request->status;

        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $data['image'] = $image_full_name;

        }

        $insertData = Slides::create($data);

        if ($insertData) {

            return redirect()->route('add.slides')->with('success', 'slides has been save successfully');

        } else {

            return redirect()->route('add.slides')->with('error', 'Failed to save slides');

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

        $data['editSlides'] = Slides::find($id);

        return view('pages.slides.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([

            'tagline' => 'required | string',
            'title' => 'required | string',
            'subtitle' => 'required | string',
            'link' => 'required | string',
            'status' => 'required',

        ]);

        $data = [];

        $data['tagline'] = $request->tagline;
        $data['title'] = $request->title;
        $data['subtitle'] = $request->subtitle;
        $data['link'] = $request->link;
        $data['status'] = $request->status;

        if ($request->file('image')) {

            $slides = Slides::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $slides->image);

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

        $insertData = Slides::where('id', $id)->update($data);

        if ($insertData) {

            return redirect()->route('slides.list')->with('success', 'slides has been update successfully');

        } else {

            return redirect()->route('slides.list')->with('error', 'slides to update Category');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slides = Slides::findOrFail($id);

        $image_path = storage_path('app/public/img/' . $slides->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $slides->delete();
        return redirect()->route('slides.list')->with('success', 'slides Delete Successfully');
    }

    public function inactiveSlide($id)
    {

        Slides::where('id', $id)->update(['status' => 'inactive']);

        return redirect()->route('slides.list');

    }

    public function activeSlide($id)
    {
        Slides::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('slides.list');

    }
}
