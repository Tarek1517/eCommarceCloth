<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatestType extends Model
{
    use HasFactory;
    protected $fillable = [

        'tagline',
        'title',
        'link',
        'image',
        'status'

    ];
}
