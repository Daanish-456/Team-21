<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        DB::table('newsletter_subscribers')->insert([
            'Name' => $request->name,
            'Email' => $request->email,
            'CreatedAt' => now(),
        ]);

        return back()->with('newsletter_success', 'Thank you for signing up!');
    }
}