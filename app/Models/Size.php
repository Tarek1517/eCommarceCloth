<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'slug',
        'image'

    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_size', 'size_id', 'product_id');
    }
}
