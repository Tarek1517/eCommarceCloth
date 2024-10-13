<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\About;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['aboutContents'] = About::with(['aboutsidebar'])->where('status', 'active')->get();

        return view('frontend.components.about', $data);
    }
}
