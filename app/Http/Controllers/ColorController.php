<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['colorContents'] = Color::orderBy('created_at','DESC')->get();
        return view('pages.color.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.color.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'name' => 'required | string',
            'slug' => 'required|unique:colors',
            'Code' => 'required|unique:colors'

        ]);

        $data = [];

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['Code'] = $request->Code;

        $insertData = Color::create($data);

        if ($insertData) {

            return redirect()->route('add.color')->with('success', 'Color has been save successfully');

        } else {

            return redirect()->route('add.color')->with('error', 'Failed to save Color');

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

        $data['editColor'] = Color::find($id);

        return view('pages.color.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required | string',
            'slug' => 'required|unique:colors,slug,' . $id,
        ]);

        $data = [];

        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $data['Code'] = $request->Code;


        $insertData = Color::where('id',$id)->update($data);


        if ($insertData) {

            return redirect()->route('color.list')->with('success', 'color has been update successfully');

        } else {

            return redirect()->route('color.list')->with('error', 'Failed to update color');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Color::where('id', $id)->delete();
        return redirect()->route('color.list')->with('success', 'color Delete Successfully');
    }
}
