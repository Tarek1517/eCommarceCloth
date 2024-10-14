<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Career;
use \App\Models\Affiliate;
use \App\Models\Service;
use \App\Models\Privacy;
use \App\Models\GiftCard;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['careerContents'] = Career::first();
        return view('frontend.page.careers', $data);
    }

    public function affiliates()
    {
        $data = [];
        $data['affiliatesContents'] = Affiliate::first();
        return view('frontend.page.affiliates', $data);
    }

    public function customer_service()
    {
        $data = [];
        $data['cServiceContents'] = Service::first();
        return view('frontend.page.cService', $data);
    }
    
    public function legal_privacy()
    {
        $data = [];
        $data['PrivacyContents'] = Privacy::first();
        return view('frontend.page.privacy', $data);
    }

    public function gift_card()
    {
        $data = [];
        $data['GiftCardContents'] = GiftCard::first();
        return view('frontend.page.gcard', $data);
    }
    
}
