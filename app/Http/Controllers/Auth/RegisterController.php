<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('register'); // Ensure this view matches the Blade template you have
    }

    /**
     * Handle a registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new user
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // Use 'password' field
            'is_admin' => false, // Ensure new users are not admins by default
        ]);

        // Redirect to login with a success message
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}
