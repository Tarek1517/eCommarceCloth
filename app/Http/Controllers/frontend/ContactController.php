<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;
use \App\Mail\ContactMail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['contactLists'] = ContactForm::orderBy('created_at', 'DESC')->get();

        return view('pages.contact.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'comment' => 'required|string',
        ]);

        $mailData = [];

        $mailData['name'] = $request->name;
        $mailData['email'] = $request->email;
        $mailData['phone'] = $request->phone;
        $mailData['comment'] = $request->comment;

        $insertData = ContactForm::create($mailData);

        if ($insertData) {

            Mail::to('tarek.hasan041517@gmail.com')->send(new ContactMail($mailData));
            return redirect()->back()->with('success', 'Your message has been sent successfully!');

        } else {

            return redirect()->back()->with('error', 'Your message do not sent!');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [];

        $data['contactDetails'] = ContactForm::where('id', $id)->first();

        return view('pages.contact.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContactForm::where('id', $id)->delete();
        return redirect()->route('contact.lists')->with('success', 'contact Delete Successfully');
    }

    public function contact()
    {
        return view('frontend.components.contact');
    }
}
