<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotDeals extends Model
{
    use HasFactory;

    protected $fillable = [

        'mtitle',
        'title1',
        'title2',
        'link',
        'status'
    ];
}
