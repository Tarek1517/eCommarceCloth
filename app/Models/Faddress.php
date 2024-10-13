<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faddress extends Model
{
    use HasFactory;
    protected $fillable = [

        'phone',
        'email',
        'address',
        'f_link',
        't_link',
        'I_link',
        'Y_link',
        'p_link'

    ];
}
