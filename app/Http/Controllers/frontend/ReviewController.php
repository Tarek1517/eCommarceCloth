<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Review;

class ReviewController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $data = [];

        $data['product_id'] = $request->product_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;

        $insertData = Review::create($data);

        if ($insertData) {

            return back();

        } else {

            return back()->with('error', 'Failed to Update coupons');

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
        //
    }
}
