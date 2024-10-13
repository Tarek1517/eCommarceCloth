<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\Career;

class AdminFooterController extends Controller
{
    public function edit_careers()
    {
        $data = [];
        $data['editCareer'] = Career::first();
        return view('pages.footer.career', $data);
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $descImag = Career::findOrFail($id);

        $image_path = storage_path('app/public/img/' . $descImag->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // If a new image is uploaded
        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;

            $img_file->storeAs('public/img/', $image_full_name);

            $descImag->update(['image' => $image_full_name]);

            $image_url = asset('storage/img/' . $image_full_name);
            return response()->json(['image_url' => $image_url]);
        }

        return response()->json(['error' => 'Image upload failed'], 500);
    }

    public function store_career(Request $request)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Career::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Product saved successfully!');
    }
}
