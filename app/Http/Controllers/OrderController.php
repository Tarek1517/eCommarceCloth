<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Order;
use \App\Models\OrderItem;
use \App\Models\Transaction;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];

        $data['Orders'] = Order::orderBy('created_at', 'DESC')->paginate(12);

        return view('pages.orders.index', $data);
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

        $data['order'] = Order::find($order_id);
        $data['orderItems'] = OrderItem::with(['galleryImages', 'product.color', 'product.size'])->where('order_id', $order_id)->orderBy('id')->paginate(12);
        $data['transactions'] = Transaction::where('order_id', $order_id)->first();

        return view('pages.orders.show', $data);
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
    public function update_status(Request $request)
    {

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_status' => 'required|in:delivered,canceled,pending,processing',
        ]);

        $order = Order::find($request->order_id);

        $order->status = $request->order_status;

        if ($request->order_status == 'delivered') {
            $order->delivered_date = Carbon::now();
        } elseif ($request->order_status == 'canceled') {
            $order->canceled_date = Carbon::now();
        }

        $order->save();

        if ($request->order_status == 'delivered') {
            $transaction = Transaction::where('order_id', $request->order_id)->first();

            if ($transaction) {
                $transaction->status = "approved";
                $transaction->save();
            } else {
                return back()->withErrors(['error' => 'Transaction not found for this order.']);
            }
        }

        return back()->with("status", "Status changed successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return redirect()->route('order.lists')->with('success', 'Order deleted successfully');
        }

        return redirect()->route('order.lists')->with('error', 'Order not found');
    }
}
