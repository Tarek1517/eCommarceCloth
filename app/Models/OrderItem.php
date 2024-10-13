<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [

        'product_id', 'order_id', 'price', 'quantity', 'options', 'rstatus'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }   

    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id');
    }
    
    // public function review()
    // {
    //     return $this->hasOne(Review::class,'order_item_id');
    // }




}
