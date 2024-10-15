<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \App\Models\ContactForm;
use \App\Models\Customer;
use \App\Models\Order;
use \App\Models\Products;
use \App\Models\SiteLogo;
use \App\Models\User;

class AdminController extends Controller
{
    public function index()
    {

        $data = [];

        $data['recentOrders'] = Order::orderBy('created_at', 'DESC')->get()->take(3);
        $data['dashOrderData'] = DB::select("
                                SELECT
                                    SUM(total) AS TotalAmount,
                                    SUM(IF(status = 'ordered', total, 0)) AS TotalOrderedAmount,
                                    SUM(IF(status = 'delivered', total, 0)) AS TotalDeliveredAmount,
                                    SUM(IF(status = 'canceled', total, 0)) AS TotalCanceledAmount,
                                    COUNT(*) AS Total,
                                    SUM(IF(status = 'ordered', 1, 0)) AS TotalOrdered,
                                    SUM(IF(status = 'delivered', 1, 0)) AS TotalDelivered,
                                    SUM(IF(status = 'canceled', 1, 0)) AS TotalCanceled
                                FROM orders
        ");

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        $data['earningsData'] = DB::select("
                                SELECT
                                    MONTHNAME(created_at) AS month,
                                    YEAR(created_at) AS year,
                                    SUM(total) AS TotalRevenue,
                                    COUNT(id) AS TotalOrders
                                FROM orders
                                WHERE status = 'delivered'
                                GROUP BY YEAR(created_at), MONTH(created_at)
                                ORDER BY YEAR(created_at), MONTH(created_at)
        ");

        $totalRevenue = 0;
        foreach ($data['earningsData'] as $earning) {
            $totalRevenue += $earning->TotalRevenue;
        }
        $data['totalRevenue'] = $totalRevenue;

        $TotalOrders = 0;
        foreach ($data['earningsData'] as $earning) {
            $TotalOrders += $earning->TotalOrders;
        }
        $data['TotalOrders'] = $TotalOrders;

        $revenueData = [];
        $orderData = [];

        foreach ($data['earningsData'] as $earning) {
            $revenueData[] = $earning->TotalRevenue;
            $orderData[] = $earning->TotalOrders;
        }

        $data['revenueData'] = implode(',', $revenueData);
        $data['orderData'] = implode(',', $orderData);

        return view('pages.dashboard', $data);

    }

    public function admin_users()
    {

        $data = [];
        $data['AdminUsers'] = User::orderBy('created_at', 'DESC')->get();
        return view('pages.users.admin', $data);

    }

    public function customer_users()
    {

        $data = [];
        $data['CustomerUsers'] = Customer::orderBy('created_at', 'DESC')->get();
        return view('pages.users.customer', $data);

    }

    public function create()
    {
        return view('pages.users.addadmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $existsInAdmin = User::where('email', $value)->exists();
                    $existsInUser = Customer::where('email', $value)->exists();

                    if ($existsInAdmin || $existsInUser) {
                        $fail('The email is already taken !!');
                    }
                },
            ],
            'password' => 'required|string',

        ]);

        $data = $request->only(['name', 'email']);
        $data['password'] = Hash::make($request->password);

        if ($request->file('image')) {

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/' . $image_full_name);
            $data['image'] = $image_full_name;

        }

        $insertData = User::create($data);

        if ($insertData) {

            return redirect()->route('admin.users')->with('success', 'admin has been save successfully');

        } else {

            return redirect()->route('admin.users')->with('error', 'Failed to save admin');

        }
    }

    public function destroy(Request $request, $id)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password_confirmation' => 'required|same:old_password',
        ]);

        $adminUser = User::where('u_type', 'admin')->findOrFail($id);

        if (Hash::check($request->old_password, $adminUser->password)) {

            $image_path = storage_path('app/public/img/' . $adminUser->image);

            if (!empty($adminUser->image) && file_exists($image_path)) {
                unlink($image_path);
            }

            $adminUser->delete();

            return redirect()->route('admin.users')->with('success', 'Admin deleted successfully.');
        } else {

            return redirect()->route('admin.users')->with('error', 'Incorrect password. Admin deletion failed.');
        }
    }

    public function destroy_customer(string $id)
    {
        Customer::where('id', $id)->delete();
        return redirect()->route('customer.users')->with('success', 'customer Delete Successfully');
    }

    public function edit(string $id)
    {
        $data = [];

        $data['editAdmin'] = User::find($id);

        return view('pages.setting.setting', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) use ($id) {
                    if ($value) {

                        $customerExists = Customer::where('email', $value)->where('id', '!=', $id)->exists();
                        $userExists = User::where('email', $value)->where('id', '!=', $id)->exists();

                        if ($customerExists || $userExists) {
                            $fail('The email is already taken in either customers or users!');
                        }
                    }
                },
            ],
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8',
            'new_password_confirmation' => 'nullable|same:new_password',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [];

        if ($request->filled('name')) {
            $data['name'] = $request->input('name');
        }

        if ($request->filled('email')) {
            $data['email'] = $request->input('email');
        }

        $adminUser = User::find($id);

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $adminUser->password)) {
                return redirect()->route('admin.settings', ['id' => $id])
                    ->with('error', 'Failed to update details. Incorrect old password.');
            }

            $data['password'] = bcrypt($request->new_password);
        }

        if ($request->file('image')) {

            $shopSlide = User::findOrFail($id);

            $image_path = storage_path('app/public/img/' . $shopSlide->image);

            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img/', $image_full_name);
            $data['image'] = $image_full_name;
        }

        User::where('id', $id)->update($data);

        return redirect()->route('admin.settings', ['id' => $id])
            ->with('success', 'Details have been updated successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Products::where('name', 'LIKE', "%{$query}%")
            ->with('galleryImages')
            ->limit(8)
            ->get();

        $result = $products->map(function ($product) {

            $galleryImages = $product->galleryImages->map(function ($image) {
                return asset('storage/img/' . $image->path);
            })->toArray();

            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'galleryImages' => $galleryImages,
            ];
        });

        return response()->json($result);
    }

    public function admin_logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Your are Logged Out!!! ');

    }

    public function add_logo()
    {
        $data = [];

        $data['changeLogo'] = SiteLogo::first();

        return view('pages.setting.addlogo', $data);
    }

    public function update_logo(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logo = SiteLogo::first();

        $data = [];

        if ($request->file('image')) {

            $image_path = storage_path('app/public/img/' . $logo->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $img_file = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $img_file->storeAs('public/img', $image_full_name);
            $data['image'] = $image_full_name;
        }

        $logo->update($data);

        return redirect()->route('add.logo')->with('success', 'Logo has been saved successfully.');
    }

}
