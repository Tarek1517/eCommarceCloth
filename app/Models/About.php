<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'bdescription', 'description','image','status'];


    public function aboutsidebar()
    {
        return $this->hasMany(AboutSidebar::class, 'about_id');
    }
}
