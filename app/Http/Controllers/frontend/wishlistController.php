<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use \App\Models\Products;

class wishlistController extends Controller
{
    public function index()
    {
        $data = [];

        $wishlists = Cart::instance('wishlist')->content();

        if (!empty($wishlists)) {
            foreach ($wishlists as $item) {
                explode(',', $item->color_id);
                explode(',', $item->size_id);
            }
        }

        $data['items'] = $wishlists;
        // dd($wishlists);
        // Cart::instance('wishlist')->destroy();
        return view('frontend.components.wishlist', $data);

    }

    public function add_to_wishlist(Request $request)
    {
        $product = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])->find($request->id);

        $galleryImages = $product->galleryImages ? $product->galleryImages->map(function ($image) {
            return [
                'path' => $image->path,
                'images' => $image->images,
            ];
        })->toArray() : [];

        Cart::instance('wishlist')->add([

            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $request->price,
            'options' => [
                'color_id' => $product->color,
                'size_id' => $product->size,
                'category_id' => $product->category,
                'brand_id' => $product->brand,
                'galleryImages' => $galleryImages,
            ],

        ])->associate(Products::class);

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $wishlist = Cart::instance('wishlist')->content();

        $item = $wishlist->where('id', $request->id)->first();

        if ($item) {
            Cart::instance('wishlist')->remove($item->rowId);
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        }

        return redirect()->back()->with('error', 'Product not found in wishlist.');
    }

    public function destroy($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back();
    }

    public function clear_wishlist()
    {
        Cart::instance('wishlist')->destroy();
        return redirect()->back();
    }

    public function move_to_cart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        Cart::instance('wishlist')->remove($rowId);

        $wish = Cart::instance('cart')->add([

            'id' => $item->id,
            'name' => $item->name,
            'qty' => 1,
            'price' => $item->price,
            'options' => [
                'color_id' => $item->options->color_id,
                'size_id' => $item->options->size_id,
                'galleryImages' => $item->options->galleryImages,
            ],

        ])->associate(Products::class);
        return redirect()->back();
    }
}
