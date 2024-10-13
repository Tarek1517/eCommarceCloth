<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSidebar extends Model
{
    use HasFactory;
    
    protected $fillable = ['about_id', 'stitle', 'sdescription', 'simage','side'];

    public function aboutList()
    {
        return $this->belongsTo(About::class);
    }
}
