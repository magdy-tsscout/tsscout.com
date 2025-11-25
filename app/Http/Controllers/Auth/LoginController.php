<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login'); // Ensure this view matches the Blade template you have
    }

    /**
     * Handle a login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt to log the user in
    if (Auth::attempt([
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ], $request->filled('remember'))) {
        // Authentication passed
        return redirect()->route('tools.index')->with('success', 'you have logged successfully');

      
    }

    // Authentication failed
    return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.'])->withInput();
}

}
