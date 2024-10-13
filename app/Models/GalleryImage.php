<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    protected $fillable = [

        'path',
        'featured',
        'images',
        'product_id'

    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}