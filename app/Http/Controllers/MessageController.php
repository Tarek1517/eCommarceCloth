<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class MessageController extends Controller
{ 

public function showMessages()
{
    // Get unread messages count
    $newMessagesCount = ContactForm::where('is_read', false)->count();

    // Return the view with the unread messages count
    return view('messages.index', compact('newMessagesCount'));
}

public function markAsRead()
{
    // Update all unread messages to read
    ContactForm::where('is_read', false)->update(['is_read' => true]);

    // Redirect to the page you want, e.g., order list
    return redirect()->route('contact.lists');
}

}
