<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // Add this line
        'order_id',
        'mode',
        'status',
        // any other fields you want to allow for mass assignment
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
