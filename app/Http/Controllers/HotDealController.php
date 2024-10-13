<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\HotDeals;

class HotDealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['DealsContents'] = HotDeals::orderBy('created_at', 'DESC')->get();
        return view('pages.deals.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.deals.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'mtitle' => 'required | string',
            'title1' => 'required | string',
            'title2' => 'required | string',
            'link' => 'required | string',
            'status' => 'required',
        ]);

        $data = [];

        $data['mtitle'] = $request->mtitle;
        $data['title1'] = $request->title1;
        $data['title2'] = $request->title2;
        $data['link'] = $request->link;
        $data['status'] = $request->status;

        $insertData = HotDeals::create($data);

        if ($insertData) {

            return redirect()->route('add.deals')->with('success', 'deals has been save successfully');

        } else {

            return redirect()->route('add.deals')->with('error', 'Failed to save deals');

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

        $data['editDeals'] = HotDeals::find($id);

        return view('pages.deals.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([

            'mtitle' => 'required | string',
            'title1' => 'required | string',
            'title2' => 'required | string',
            'link' => 'required | string',
        ]);

        $data = [];

        $data['mtitle'] = $request->mtitle;
        $data['title1'] = $request->title1;
        $data['title2'] = $request->title2;
        $data['link'] = $request->link;
       
        $insertData = HotDeals::where('id', $id)->update($data);

        if ($insertData) {

            return redirect()->route('deals.list')->with('success', 'deals has been update successfully');

        } else {

            return redirect()->route('deals.list')->with('error', 'Failed to update deals');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deals = HotDeals::findOrFail($id);
        $deals->delete();
        return redirect()->route('deals.list')->with('success', 'deals Delete Successfully');
    }

    public function inactiveDeals($id)
    {

        HotDeals::where('id', $id)->update(['status' => 'inactive']);

        return redirect()->route('deals.list');

    }

    public function activeDeals($id)
    {

        HotDeals::where('status', 'active')->update(['status' => 'pending']);
        HotDeals::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('deals.list');
    }

}
