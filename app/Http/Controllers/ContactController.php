<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function createTicket(Request $request) {
        //do the database stuff for this
        $values = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        return redirect()->back()->with('success', 'Thanks for contacting Stone & Soul. Ticket successfully submitted.');
    }
}
