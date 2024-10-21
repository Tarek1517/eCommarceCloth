<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use \App\Models\Address;
use \App\Models\Coupon;
use \App\Models\Order;
use \App\Models\OrderItem;
use \App\Models\Transaction;

class CartController extends Controller
{

    public function index()
    {
        $data = [];

        $cartItems = Cart::instance('cart')->content();

        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                explode(',', $item->color_id);
                explode(',', $item->size_id);
            }
        }

        $data['items'] = $cartItems;
        // dd($cartItems);
        // Cart::instance('cart')->destroy();
        return view('frontend.components.cart', $data);

    }

    public function add_to_cart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'required|integer|exists:colors,id',
            'size_id' => 'required|integer|exists:sizes,id',
        ]);

        $product = \App\Models\Products::with('size', 'color')->find($request->id);

        $galleryImages = $product->galleryImages ? $product->galleryImages->pluck('path')->toArray() : [];

        // Check if the same product with same size and color exists in the cart
        $cartItem = Cart::instance('cart')->content()->where('id', $product->id)
            ->where('options.color_id', $request->color_id)
            ->where('options.size_id', $request->size_id)
            ->first();

        if ($cartItem) {
            // If the product exists, update the quantity
            Cart::instance('cart')->update($cartItem->rowId, $cartItem->qty + $request->quantity);
        } else {
            // If the product does not exist, add it to the cart
            Cart::instance('cart')->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $request->quantity,
                'price' => $request->price,
                'options' => [
                    'color_id' => $request->color_id,
                    'size_id' => $request->size_id,
                    'galleryImages' => $galleryImages,
                ],
            ])->associate(\App\Models\Products::class);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function increaseQuantity($rowId)
    {
        $cartItem = Cart::instance('cart')->get($rowId);

        if ($cartItem) {
            $qty = $cartItem->qty + 1;
            Cart::instance('cart')->update($rowId, $qty);
        }
        return redirect()->back();
    }

    public function decreaseQuantity($rowId)
    {
        $cartItem = Cart::instance('cart')->get($rowId);

        if ($cartItem) {
            $qty = $cartItem->qty - 1;
            if ($qty < 1) {
                $qty = 1;
            }
            Cart::instance('cart')->update($rowId, $qty);
        }
        return redirect()->back();
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }
    public function clear_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon(request $request)
    {
        $coupon_code = $request->coupon_code;
        if (isset($coupon_code)) {
            $coupon = Coupon::where('code', $coupon_code)
                ->where('status', 'Active')
                ->where('expiry_date', '>=', \Carbon\Carbon::today())
                ->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first();

            if (!$coupon) {
                return back()->with('error', 'Invalid coupon code!');
            }

            session()->put('coupon', [
                'code' => $coupon->code,
                'value' => $coupon->value,
                'type' => $coupon->type,
                'cart_value' => $coupon->cart_value,
            ]);

            $discount = 0;
            if (session()->has('coupon')) {
                if (session()->get('coupon')['type'] == 'fixed') {
                    $discount = session()->get('coupon')['value'];
                } else {
                    $discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
                }
                $subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
                $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 100;
                $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;

                session()->put('discounts', [
                    'discount' => number_format(floatval($discount), 2, '.', ''),
                    'subtotal' => number_format(floatval(Cart::instance('cart')->subtotal() - $discount), 2, '.', ''),
                    'tax' => number_format(floatval((($subtotalAfterDiscount * config('cart.tax')) / 100)), 2, '.', ''),
                    'total' => number_format(floatval($totalAfterDiscount), 2, '.', ''),
                ]);

                return redirect()->back()->with('success', 'Applied Coupon Successfully ');
            }

        } else {
            return back()->with('error', 'Invalid or expired coupon code!');
        }

    }

    public function clear_coupon()
    {
        Session::forget('coupon');
        Session::forget('discounts');
        return redirect()->back()->with('success', 'Coupon Remove successfully');
    }

    public function checkout()
    {
        if (Auth::guard('customer')->check()) {
            $data = [];

            $data['address'] = Address::where('user_id', Auth::guard('customer')->id())
                ->where('isdefault', 1)
                ->first();

            return view('frontend.components.checkout', $data);
        } else {

            return redirect()->route('Customer.login');
        }
    }

    public function place_an_order(Request $request)
    {
        $user_id = Auth::guard('customer')->id();

        // Fetch or create default address
        $address = Address::where('user_id', $user_id)->where('isdefault', 1)->first();

        if (!$address) {
            // Validate address fields if the user has no default address
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

            // Create new address
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
                'user_id' => $user_id,
                'isdefault' => true,
            ];

            $address = Address::create($addressData);

            if (!$address) {
                return back()->with('error', 'Address could not be created. Please try again.');
            }
        }

        // Ensure the cart has items
        if (Cart::instance('cart')->count() <= 0) {
            session()->forget('checkout');
            return back()->with('error', 'Your cart is empty.');
        }

        // Handle coupon or normal checkout pricing
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => session()->get('discounts')['discount'],
                'subtotal' => session()->get('discounts')['subtotal'],
                'tax' => session()->get('discounts')['tax'],
                'total' => session()->get('discounts')['total'],
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create order
            $orderData = [
                'user_id' => $user_id,
                'subtotal' => session()->get('checkout')['subtotal'],
                'discount' => session()->get('checkout')['discount'],
                'tax' => session()->get('checkout')['tax'],
                'total' => session()->get('checkout')['total'],
                'name' => $address->name,
                'phone' => $address->phone,
                'locality' => $address->locality,
                'address' => $address->address,
                'city' => $address->city,
                'state' => $address->state,
                'country' => $address->country,
                'landmark' => $address->landmark,
                'zip' => $address->zip,
            ];

            $order = Order::create($orderData);

            // Create order items
            foreach (Cart::instance('cart')->content() as $item) {
                // Ensure you're only taking selected options (color and size)
                $orderItemData = [
                    'product_id' => $item->id,
                    'order_id' => $order->id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'options' => isset($item->options) ? json_encode($item->options) : null, // Store color and size here
                ];

                OrderItem::create($orderItemData);
            }

            // Handle payment mode
            if ($request->mode === 'cod') {
                $transactionData = [
                    'user_id' => $user_id,
                    'order_id' => $order->id,
                    'mode' => $request->mode,
                    'status' => "pending",
                ];
                Transaction::create($transactionData);
            } elseif ($request->mode === 'card') {
                return back()->with('error', 'Card payments will be available soon!');
            } else {
                return back()->with('error', 'Paypal payments will be available soon!');
            }

            // Clear cart and session data
            Cart::instance('cart')->destroy();
            session()->forget('checkout');
            session()->forget('coupon');
            session()->forget('discounts');
            session()->put('order_id', $order->id);

            // Commit transaction
            DB::commit();

            return redirect()->route('order.confirmation');

        } catch (\Exception $e) {
            // Rollback transaction if any error occurs
            DB::rollback();
            return back()->with('error', 'There was a problem placing your order. Please try again.');
        }
    }

    public function confirmation()
    {
        $data = [];
        $data['order_id'] = $order_id = session('order_id');
        $data['order'] = Order::with('orderItems.product')->find($order_id);
        return view('frontend.components.confirmation', $data);
    }

}
