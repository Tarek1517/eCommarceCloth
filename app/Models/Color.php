<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'slug',
        'Code'

    ];

    public function product()
    {
        return $this->belongsToMany(Products::class, 'product_color', 'color_id', 'product_id');
    }
}
