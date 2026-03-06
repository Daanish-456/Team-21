<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function createTicket(Request $request)
    {
        $values = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        ContactMessage::create([
            'Name' => $values['name'],
            'Email' => $values['email'],
            'Message' => $values['message'],
            'UserID' => session('UserID'),
            'CreatedAt' => now()
        ]);

        return redirect()->back()->with(
            'success',
            'Thanks for contacting Stone & Soul. Ticket successfully submitted.'
        );
    }
}