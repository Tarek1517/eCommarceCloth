<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \App\Models\Brand;
use \App\Models\Category;
use \App\Models\Color;
use \App\Models\GalleryImage;
use \App\Models\Products;
use \App\Models\Review;
use \App\Models\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['allProducts'] = Products::orderBy('created_at', 'DESC')->paginate(12);
        return view('pages.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['categories'] = Category::get();
        $data['brands'] = Brand::get();
        $data['colors'] = Color::get();
        $data['sizes'] = Size::get();

        return view('pages.product.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:products',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'regular_price' => 'nullable',
            'sale_price' => 'nullable',
            'SKU' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock_status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'size_id' => 'required|array',
            'color_id' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'quantity' => $request->quantity,
            'stock_status' => $request->stock_status,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ];

        $product = Products::create($data);

        if ($request->size_id) {
            $product->size()->attach($request->size_id);
        }

        if ($request->color_id) {
            $product->color()->attach($request->color_id);
        }

        $imageGallery = [];
        if ($request->file('path')) {
            $img_file = $request->file('path');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name_forPath = $image_name . '.' . $ext;
            $img_file->storeAs('public/img', $image_full_name_forPath);
            $imageGallery['path'] = $image_full_name_forPath;
        }

        if ($request->file('images')) {
            $gallery_img = [];
            foreach ($request->file('images') as $img_file) {
                $image_name = Str::random(20);
                $ext = strtolower($img_file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $img_file->storeAs('public/img', $image_full_name);
                $gallery_img[] = $image_full_name;
            }

            $imageGallery = [
                'path' => $image_full_name_forPath,
                'featured' => $request->featured,
                'product_id' => $product->id,

            ];

            if (!empty($gallery_img)) {
                $imageGallery['images'] = implode(',', $gallery_img);
            }
        }

        $imageGallery['featured'] = $request->featured;
        $imageGallery['product_id'] = $product->id;
        GalleryImage::create($imageGallery);

        if ($product) {
            return redirect()->route('add.product')->with('success', 'Product has been saved successfully');
        } else {
            return redirect()->route('add.product')->with('error', 'Failed to save product');
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

        $data['editProduct'] = Products::with(['category', 'brand', 'color', 'size', 'galleryImages'])->find($id);

        $data['categories'] = Category::all();
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sizes'] = Size::all();
        $data['GImages'] = GalleryImage::all();

        return view('pages.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:products,slug,' . $id,
            'short_description' => 'required|string',
            'description' => 'required|string',
            'regular_price' => 'nullable',
            'sale_price' => 'nullable',
            'SKU' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'stock_status' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'size_id' => 'required|array',
            'color_id' => 'required|array',
        ]);

        $product = Products::find($id);

        if (!$product) {
            return redirect()->route('product.list')->with('error', 'Product not found');
        }

        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'SKU' => $request->SKU,
            'quantity' => $request->quantity,
            'stock_status' => $request->stock_status,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ];

        $product->update($data);

        if ($request->size_id) {
            $product->size()->sync($request->size_id);
        } else {
            $product->size()->detach();
        }

        if ($request->color_id) {
            $product->color()->sync($request->color_id);
        } else {
            $product->color()->detach();
        }

        $imageGallery = [];

        if ($request->file('path')) {
            $img_file = $request->file('path');
            $image_name = Str::random(20);
            $ext = strtolower($img_file->getClientOriginalExtension());
            $image_full_name_forPath = $image_name . '.' . $ext;
            $img_file->storeAs('public/img', $image_full_name_forPath);
            $imageGallery['path'] = $image_full_name_forPath;
        }

        if ($request->file('images')) {
            $gallery_img = [];
            foreach ($request->file('images') as $img_file) {
                $image_name = Str::random(20);
                $ext = strtolower($img_file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $img_file->storeAs('public/img', $image_full_name);
                $gallery_img[] = $image_full_name;
            }

            if (!empty($gallery_img)) {
                $imageGallery['images'] = implode(',', $gallery_img);
            }
        }

        $imageGallery['featured'] = $request->featured;

        GalleryImage::where('product_id', $id)->update($imageGallery);

        return redirect()->route('product.list')->with('success', 'Product has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::findOrFail($id)->delete();
        return redirect()->route('product.list')->with('success', 'Product Delete Successfully');
    }

    public function create_Gallery()
    {
        $data = [];
        $data['gallery'] = GalleryImage::orderBy('created_at', 'DESC')->get();
        return view('pages.product.addgallery', $data);
    }

    public function review()
    {
        $data = [];
        $data['productReview'] = Review::orderBy('created_at', 'DESC')->get();
        return view('pages.product.review', $data);
    }

    public function pending_review($id)
    {

        Review::where('id', $id)->update(['status' => 'pending']);

        return redirect()->route('product.review');

    }

    public function approved_review($id)
    {
        Review::where('id', $id)->update(['status' => 'approved']);

        return redirect()->route('product.review');

    }

    public function destroy_Review(string $id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->route('product.review')->with('success', 'Review Delete Successfully');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            GalleryImage::whereIn('product_id', $ids)->delete();
            Products::whereIn('id', $ids)->delete();

            return redirect()->back()->with('success', 'Products and associated items deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No Products selected.');
        }
    }

}
