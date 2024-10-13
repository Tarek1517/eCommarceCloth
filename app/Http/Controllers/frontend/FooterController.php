<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.page.careers');
    }

    public function affiliates()
    {
        return view('frontend.page.affiliates');
    }

    public function customer_service()
    {
        return view('frontend.page.cService');
    }

    public function find_store()
    {
        return view('frontend.page.fStore');
    }
    
    public function legal_privacy()
    {
        return view('frontend.page.privacy');
    }

    public function gift_card()
    {
        return view('frontend.page.gcard');
    }
    
}
