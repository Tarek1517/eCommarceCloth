<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Career;
use \App\Models\Affiliate;
use \App\Models\Service;
use \App\Models\Privacy;
use \App\Models\GiftCard;

class AdminFooterController extends Controller
{
    public function edit_careers()
    {
        $data = [];
        $data['editCareer'] = Career::first();
        return view('pages.footer.career', $data);
    }

    public function edit_affiliates()
    {
        $data = [];
        $data['editAffiliate'] = Affiliate::first();
        return view('pages.footer.affiliate', $data);
    }

    public function edit_cService()
    {
        $data = [];
        $data['editService'] = Service::first();
        return view('pages.footer.service', $data);
    }

    public function edit_Privacy()
    {
        $data = [];
        $data['editPrivacy'] = Privacy::first();
        return view('pages.footer.privacy', $data);
    }

    public function edit_gCard()
    {
        $data = [];
        $data['editCard'] = GiftCard::first();
        return view('pages.footer.gCard', $data);
    }


    public function update_career(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Career::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Career update successfully!');
    }

    public function update_affiliate(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Affiliate::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Affiliate update successfully!');
    }

    public function update_cService(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Service::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Service update successfully!');
    }

    public function update_Privacy(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        Privacy::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Privacy update successfully!');
    }

    public function update_gCard(Request $request, string $id)
    {
        request()->validate([

            'name' => 'required | string',
            'description' => 'required',

        ]);

        GiftCard::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'GiftCard update successfully!');
    }
}

