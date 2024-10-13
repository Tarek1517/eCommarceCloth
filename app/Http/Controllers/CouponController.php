<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['couponContents'] = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('pages.coupon.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.coupon.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Request()->validate([

            'code' => 'required | string | unique:coupons',
            'type' => 'required',
            'value' => 'required | numeric ',
            'cart_value' => 'required | numeric ',
            'expiry_date' => 'required | date',
            
        ]);

        $data = [];

        $data['code'] = $request->code;
        $data['type'] = $request->type;
        $data['value'] = $request->value;
        $data['cart_value'] = $request->cart_value;
        $data['expiry_date'] = $request->expiry_date;

        $insertData = Coupon::create($data);

        if ($insertData) {

            return redirect()->route('add.coupons')->with('success', 'coupons has been save successfully');

        } else {

            return redirect()->route('add.coupons')->with('error', 'Failed to save coupons');

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

        $data['editCoupons'] = Coupon::find($id);

        return view('pages.coupon.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Request()->validate([

            'code' => 'required | string | unique:coupons,code,' .$id,
            'type' => 'required',
            'value' => 'required | numeric ',
            'cart_value' => 'required | numeric ',
            'expiry_date' => 'required | date',
            
        ]);

        $data = [];

        $data['code'] = $request->code;
        $data['type'] = $request->type;
        $data['value'] = $request->value;
        $data['cart_value'] = $request->cart_value;
        $data['expiry_date'] = $request->expiry_date;

        $insertData = Coupon::where('id',$id)->update($data);

        if ($insertData) {

            return redirect()->route('coupons.list')->with('success', 'coupons has been Update successfully');

        } else {

            return redirect()->route('coupons.list')->with('error', 'Failed to Update coupons');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::where('id', $id)->delete();
        return redirect()->route('coupons.list')->with('success', 'Coupons Delete Successfully');
    }

    public function pendingCoupons($id)
    {

        Coupon::where('id', $id)->update(['status' => 'pending']);

        return redirect()->route('coupons.list');

    }

    public function activeCoupons($id)
    {
        Coupon::where('status', 'active')->update(['status' => 'pending']);
        Coupon::where('id', $id)->update(['status' => 'active']);

        return redirect()->route('coupons.list');

    }
}
