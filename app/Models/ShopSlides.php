<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopSlides extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'btitle',
        'description',
        'image',
        'status'

    ];
}
