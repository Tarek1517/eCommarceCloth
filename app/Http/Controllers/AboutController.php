<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\About;
use \App\Models\AboutSidebar;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['aboutContents'] = About::with('aboutsidebar')->orderBy('created_at', 'DESC')->get();

        return view('pages.about.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.about.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'title' => 'required | string',
            'bdescription' => 'required | string',
            'description' => 'required | string',
            'image' => 'required',
            'stitle' => 'required|array',
            'sdescription' => 'required|array',
            'simage' => 'required|array|nullable',
            'side' => 'required|array',

        ]);

        $stitle = $request->stitle;
        $sdescription = $request->sdescription;
        $side = $request->side;

        $aboutData = [];

        $aboutData['title'] = $request->title;
        $aboutData['bdescription'] = $request->bdescription;
        $aboutData['description'] = $request->description;

        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $aboutData['image'] = $image_full_name;

        }

        $about = About::create($aboutData);

        $sidebarDataFinal = [];

        if (isset($about->id)) {
            foreach ($stitle as $key => $title) {
                $image_full_name = null;

                if ($request->file('simage') && isset($request->file('simage')[$key])) {
                    $img_file = $request->file('simage')[$key];
                    $image_name = Str::random(20);
                    $ext = strtolower($img_file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $img_file->storeAs('public/img', $image_full_name);
                }

                $sidebarDataFinal[] = [
                    'about_id' => $about->id,
                    'stitle' => $title,
                    'sdescription' => $sdescription[$key],
                    'side' => $side[$key],
                    'simage' => $image_full_name,
                ];
            }
        }

        foreach ($sidebarDataFinal as $sidebar) {
            $sidebar = AboutSidebar::create($sidebar);
        }

        if ($about && $sidebar) {

            return redirect()->route('add.about')->with('success', 'About us  page Data has been save successfully');

        } else {

            return redirect()->route('add.about')->with('error', 'About us page Data is not save');

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

        $data['editAbout'] = About::with(['aboutsidebar'])->find($id);

        return view('pages.about.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string',
            'bdescription' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'stitle' => 'required|array',
            'sdescription' => 'required|array',
            'simage' => 'nullable|array',
            'side' => 'required|array',
            'sidebar_id' => 'nullable|array',
        ]);

        $aboutData = [
            'title' => $request->title,
            'bdescription' => $request->bdescription,
            'description' => $request->description,
        ];

        $about = About::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {

            if ($about->image) {
                $old_image_path = storage_path('app/public/img/' . $about->image);
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img', $image_full_name);
            $aboutData['image'] = $image_full_name;
        }

        $about->update($aboutData);

        $stitle = $request->stitle;
        $sdescription = $request->sdescription;
        $side = $request->side;
        $sidebar_id = $request->sidebar_id ?? [];

        foreach ($stitle as $key => $title) {
            $sidebarData = [
                'about_id' => $about->id,
                'stitle' => $title,
                'sdescription' => $sdescription[$key],
                'side' => $side[$key],
            ];

            if (isset($sidebar_id[$key]) && $sidebar_id[$key]) {

                $sidebar = AboutSidebar::where(['id' => $sidebar_id[$key], 'about_id' => $id])->firstOrFail();

                if ($request->hasFile('simage') && isset($request->file('simage')[$key])) {

                    if ($sidebar->simage) {
                        $old_sidebar_image_path = storage_path('app/public/img/' . $sidebar->simage);
                        if (file_exists($old_sidebar_image_path)) {
                            unlink($old_sidebar_image_path);
                        }
                    }

                    $img_file = $request->file('simage')[$key];
                    $image_name = Str::random(20);
                    $ext = strtolower($img_file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $img_file->storeAs('public/img', $image_full_name);
                    $sidebarData['simage'] = $image_full_name;
                }

                $sidebar->update($sidebarData);

            } else {


                if (isset($request->file('simage')[$key])) {
                    $img_file = $request->file('simage')[$key];
                    $image_name = Str::random(20);
                    $ext = strtolower($img_file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $img_file->storeAs('public/img', $image_full_name);
                    $sidebarData['simage'] = $image_full_name;
                }

                AboutSidebar::create($sidebarData);
            }
        }

        return redirect()->route('about.list')->with('success', 'About us page data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $delete = About::with('aboutsidebar')->find($id);

        $image_path = storage_path('app/public/img/' . $delete->image);
        if (!empty($image_path) && file_exists($image_path)) {
            unlink($image_path);
        }

        if ($delete->aboutsidebar) {
            foreach ($delete->aboutsidebar as $sidebar) {
                $side_image = storage_path('app/public/img/' . $sidebar->simage);
                if (!empty($side_image) && file_exists($side_image)) {
                    unlink($side_image);
                }
            }
        }

        $delete->delete();
        $delete->aboutsidebar()->delete();

        return redirect()->route('about.list')->with('success', 'Data deleted successfully');
    }

    public function pendingAbout($id)
    {

        About::where('id', $id)->update(['status' => 'pending']);

        return redirect()->route('about.list');

    }

    public function activeAbout($id)
    {
        About::where('status', 'active')->update(['status' => 'pending']);
        About::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('about.list');

    }

}
