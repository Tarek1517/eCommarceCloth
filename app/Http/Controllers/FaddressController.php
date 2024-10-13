<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Faddress;

class FaddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['fAddressContents'] = Faddress::orderBy('created_at', 'DESC')->get();
        return view('pages.fAddress.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.fAddress.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([

            'address' => 'required | string',
            'email' => 'required | string',
            'phone' => 'required',
            'f_link' => 'required',

        ]);

        $data = [];

        $data['address'] = $request->address;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['f_link'] = $request->f_link;
        $data['t_link'] = $request->t_link;
        $data['I_link'] = $request->I_link;
        $data['Y_link'] = $request->Y_link;
        $data['p_link'] = $request->p_link;

        $insertData = Faddress::create($data);

        if ($insertData) {

            return redirect()->route('add.faddress')->with('success', 'Faddress Data has been save successfully');

        } else {

            return redirect()->route('add.faddress')->with('error', 'Faddress Data Data is not save');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faddress::where('id', $id)->delete();
        return redirect()->route('faddress.lists')->with('success', 'Faddress Delete Successfully');
    }

    public function pendingFaddress($id)
    {

        Faddress::where('id', $id)->update(['status' => 'pending']);

        return redirect()->route('faddress.lists');

    }

    public function activeFaddress($id)
    {
        Faddress::where('status', 'active')->update(['status' => 'pending']);
        Faddress::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('faddress.lists');

    }
}
