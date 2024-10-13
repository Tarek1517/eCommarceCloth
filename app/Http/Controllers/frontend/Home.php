<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \App\Models\Category;
use \App\Models\Coupon;
use \App\Models\Customer;
use \App\Models\HotDeals;
use \App\Models\LatestType;
use \App\Models\Products;
use \App\Models\Slides;
use \App\Models\User;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['SlidesCon'] = Slides::where('status', 'active')->get()->take(3);
        $data['categories'] = Category::orderBy('name')->get();
        $data['dealsCon'] = HotDeals::where('status', 'active')->get();
        $data['coupons'] = Coupon::where('status', 'active')->get();

        $data['dealsProduct'] = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])
            ->whereNotNull('sale_price')->where('sale_price', '<>', '')
            ->inRandomOrder()->get()->take(6);
        $data['TypeCon'] = LatestType::where('status', 'active')->get()->take(2);

        $data['fproduct'] = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])
            ->whereHas('galleryImages', function ($query) {
                $query->where('featured', 1);
            })
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        return view('frontend.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('frontend.page.login');
    }

    public function register()
    {
        return view('frontend.page.register');
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'mobile' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        // Extract the validated data
        $data = $request->only(['name', 'email', 'mobile']);
        $data['password'] = Hash::make($request->password);

        $user = Customer::create($data);

        if ($user) {
            return redirect()->route('customer.register')->with('success', 'Your registration is complete');
        } else {
            return redirect()->route('customer.register')->with('error', 'Registration failed');
        }
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['email' => 'Your Email or Password is wrong !!!']);
    }

    public function customer_search(Request $request)
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
                'name' => $product->name,
                'slug' => $product->slug,
                'galleryImages' => $galleryImages,
            ];
        });

        return response()->json($result);
    }

}
