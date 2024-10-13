<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \App\Models\Address;
use \App\Models\Customer;
use \App\Models\Order;
use \App\Models\OrderItem;
use \App\Models\Transaction;
use \App\Models\User;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.page.intro');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];

        $data['CustomerOrders'] = Order::where('user_id', Auth::guard('customer')->user()->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('frontend.page.customerorders', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order_id)
    {
        $data = [];

        $order = Order::where('user_id', Auth::guard('customer')->user()->id)->where('id', $order_id)->first();

        $data['order'] = $order;

        $data['orderItems'] = OrderItem::with(['galleryImages'])
            ->where('order_id', $order->id)
            ->orderBy('id')
            ->paginate(12);

        $data['transactions'] = Transaction::where('order_id', $order->id)->first();

        return view('frontend.page.corderdetails', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];

        $data['editAddress'] = Address::find($id);

        return view('frontend.page.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'zip' => 'required|numeric',
            'locality' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'landmark' => 'required|string',
        ]);

        $addressData = [

            'name' => $request->name,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'locality' => $request->locality,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'landmark' => $request->landmark,
            'isdefault' => true,
        ];

        $insertData = Address::where('id', $id)->update($addressData);

        if ($insertData) {

            return redirect()->route('customer.address')->with('success', 'address has been update successfully');

        } else {

            return redirect()->route('customer.address')->with('error', 'Failed to update address');

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function cancel_order(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with("status", "Order has been cancelled successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('Customer.login')->with('success', 'Your are Logged Out!!! ');

    }

    public function address()
    {
        $data = [];

        $data['CustomerAddress'] = Address::where('user_id', Auth::guard('customer')->id())
            ->where('isdefault', 1)
            ->first();

        return view('frontend.page.address', $data);
    }

    public function details(string $id)
    {
        $data = [];

        $data['accountDetails'] = Customer::find($id);

        return view('frontend.page.accountdetails', $data);
    }

    public function update_details(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|numeric',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($id) {

                    $customerExists = Customer::where('email', $value)->where('id', '!=', $id)->exists();

                    $userExists = User::where('email', $value)->exists();

                    if ($customerExists || $userExists) {
                        $fail('The email is already taken in either customers or users!');
                    }
                },
            ],
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8',
            'new_password_confirmation' => 'nullable|same:new_password',
        ]);

        $accountData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ];

        $customer = Customer::find($id);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $customer->password)) {
                return redirect()->route('account.details', ['id' => $id])
                    ->with('error', 'Failed to update details. Incorrect old password.');
            }

            $accountData['password'] = bcrypt($request->new_password);
        }

        $customer->update($accountData);

        return redirect()->route('account.details', ['id' => $id])
            ->with('success', 'Details have been updated successfully');
    }

    public function wishlist()
    {
        $data = [];

        $wishlists = Cart::instance('wishlist')->content();

        if (!empty($wishlists)) {
            foreach ($wishlists as $item) {
                explode(',', $item->color_id);
                explode(',', $item->size_id);
            }
        }

        $data['customerWishlist'] = $wishlists;
        // dd($data['customerWishlist']);
        return view('frontend.page.cWishlists', $data);

    }

}
