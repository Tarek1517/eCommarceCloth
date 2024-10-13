<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [

        'name', 'slug', 'short_description', 'description', 'regular_price', 'sale_price', 'SKU',
        'stock_status', 'featured', 'quantity', 'image', 'imageGallery', 'category_id', 'brand_id', 'color_id', 'size_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class, 'product_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            foreach ($product->galleryImages as $galleryImage) {

                $image_path = storage_path('app/public/img/' . $galleryImage->path);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                if (!empty($galleryImage->images)) {

                    $images_array = explode(',', $galleryImage->images);

                    foreach ($images_array as $image) {
                        $image = trim($image);
                        $images_path = storage_path('app/public/img/' . $image);

                        if (file_exists($images_path)) {
                            unlink($images_path);
                        }
                    }
                }
            }

            $product->galleryImages()->delete();
        });
    }

}
