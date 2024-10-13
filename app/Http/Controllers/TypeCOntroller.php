<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\LatestType;

class TypeCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['typeContents'] = LatestType::orderBy('created_at', 'DESC')->get();
        return view('pages.type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.type.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'tagline' => 'required | string',
            'title' => 'required | string',
            'link' => 'required | string',
            'status' => 'required',
            'image' => 'required',

        ]);

        $data = [];

        $data['tagline'] = $request->tagline;
        $data['title'] = $request->title;
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

        $insertData = LatestType::create($data);

        if ($insertData) {

            return redirect()->route('add.type')->with('success', 'type has been save successfully');

        } else {

            return redirect()->route('add.type')->with('error', 'Failed to save type');

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

        $data['editType'] = LatestType::find($id);

        return view('pages.type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([

            'tagline' => 'required | string',
            'title' => 'required | string',
            'link' => 'required | string',
            'status' => 'required',

        ]);

        $data = [];

        $data['tagline'] = $request->tagline;
        $data['title'] = $request->title;
        $data['link'] = $request->link;
        $data['status'] = $request->status;

        if ($request->file('image')) {

            $type = LatestType::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $type->image);

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

        $insertData = LatestType::where('id', $id)->update($data);

        if ($insertData) {

            return redirect()->route('type.list')->with('success', 'type has been update successfully');

        } else {

            return redirect()->route('type.list')->with('error', 'failed to update type');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = LatestType::findOrFail($id);

        $image_path = storage_path('app/public/img/' . $type->image);

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $type->delete();
        return redirect()->route('type.list')->with('success', 'type Delete Successfully');
    }

    public function inactiveType($id)
    {

        LatestType::where('id', $id)->update(['status' => 'inactive']);

        return redirect()->route('type.list');

    }

    public function activeType($id)
    {
        LatestType::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('type.list');

    }
}
