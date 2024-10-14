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

    public function edit_affiliates()
    {
        $data = [];
        $data['editCareer'] = Career::first();
        return view('pages.footer.career', $data);
    }

    public function update_career(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Career::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Career update successfully!');
    }
}
