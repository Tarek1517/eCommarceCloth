<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use \App\Models\Brand;
use \App\Models\Category;
use \App\Models\Color;
use \App\Models\GalleryImage;
use \App\Models\Products;
use \App\Models\ShopSlides;
use \App\Models\Size;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        $order = $request->query('order', -1);
        $slug = $request->query('slug');
        $filter_brands = $request->query('brands');
        $filter_categories = $request->query('categories');
        $filter_sizes = $request->query('sizes');
        $filter_colors = $request->query('colors');
        $min_price = $request->query('min') ? $request->query('min') : 1 ;
        $max_price = $request->query('max') ? $request->query('max') : 500 ;

        $data['order'] = $order;
        $data['min_price'] = $min_price;
        $data['max_price'] = $max_price;
        $data['filter_brands'] = $filter_brands;
        $data['filter_categories'] = $filter_categories;
        $data['filter_sizes'] = $filter_sizes;
        $data['filter_colors'] = $filter_colors;

        $o_column = 'id';
        $o_order = 'DESC';

        switch ($order) {
            case 1:
                $o_column = 'created_at';
                $o_order = 'DESC';
                break;
            case 2:
                $o_column = 'created_at';
                $o_order = 'ASC';
                break;
            case 3:
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;
            case 4:
                $o_column = 'sale_price';
                $o_order = 'ASC';
                break;
        }

        $data['shopProducts'] = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])
            ->when($filter_brands, function ($query, $filter_brands) {
                $query->whereIn('brand_id', explode(',', $filter_brands));
            })
            ->when($filter_categories, function ($query, $filter_categories) {
                $query->whereIn('category_id', explode(',', $filter_categories));
            })
            ->when($filter_sizes, function ($query) use ($filter_sizes) {
                $query->whereHas('size', function ($query) use ($filter_sizes) {
                    $query->whereIn('sizes.id', explode(',', $filter_sizes));
                });
            })
            ->when($filter_colors, function ($query) use ($filter_colors) {
                $query->whereHas('color', function ($query) use ($filter_colors) {
                    $query->whereIn('colors.id', explode(',', $filter_colors));
                });
            })
            ->where(function ($query) use ($min_price, $max_price) {
                $query->whereBetween('regular_price', [$min_price, $max_price])
                      ->orWhereBetween('sale_price', [$min_price, $max_price]);
            })
            ->when($slug, function ($query) use ($slug) {
                $query->whereHas('category', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                });
            })
            ->orderBy($o_column, $o_order)
            ->paginate(9);

        $data['brands'] = Brand::orderBy('name', 'ASC')->get();
        $data['categories'] = Category::orderBy('name', 'ASC')->get();
        $data['sizes'] = Size::orderBy('name', 'ASC')->get();
        $data['colors'] = Color::orderBy('name', 'ASC')->get();
        $data['shopSlidesCon'] = ShopSlides::where('status', 'active')->inRandomOrder()->get()->take(3);

        return view('frontend.components.shop', $data);
    }

    public function product_details($product_slug)
    {

        $ProductDetails = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])
            ->where('slug', $product_slug)
            ->firstOrFail();

        $data = [];

        $data['ProductDetails'] = $ProductDetails;

        $categoryId = $ProductDetails->category_id;

        $data['relatedProducts'] = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])
            ->where('category_id', $categoryId)
            ->where('id', '!=', $ProductDetails->id)
            ->take(6)
            ->get();

        $data['GImages'] = GalleryImage::all();

        $cartItem = Cart::instance('cart')->content()->where('id', $ProductDetails->id)->first();

        $data['isAddedCart'] = $cartItem ? 1 : 0;

        if ($cartItem) {
            $data['selectedSize'] = $cartItem->options->size_id ?? null;
            $data['selectedColor'] = $cartItem->options->color_id ?? null;
        } else {
            $data['selectedSize'] = null;
            $data['selectedColor'] = null;
        }

        return view('frontend.components.details', $data);
    }

}
