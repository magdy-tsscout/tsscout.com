<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactsController extends Controller
{
    private string $send_to;
    public function __construct() {
        $this->send_to = config('mail.send_to');
    }
    public function store(Request $request)  {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'msg' => 'required|string',
        ]);

        Mail::to($this->send_to)->send(new ContactFormMail($validated));

        return response()->json([
            'message' => 'Contact form submitted successfully.',
        ]);
    }
}
