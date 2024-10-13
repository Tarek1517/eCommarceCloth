<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id', 'name', 'phone', 'locality', 'address', 'city','state','country','landmark','zip','type','isdefault'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
