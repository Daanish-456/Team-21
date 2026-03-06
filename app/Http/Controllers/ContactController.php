<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
   public function createTicket(Request $request) {
    dd($request->all());
}
}