<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
class AuthController extends BaseController
{
    public function registerForm()
    {
        return Inertia::render('Auth/Register');
    }
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return redirect(to: '/register')->withErrors($validator)->withInput();
        }
        $user = User::create($request->all());
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
        //Checks if the user was trying to visit a protected route before logging in. //If yes, redirects them back to that route. //If not, goes to /dashboard.
    }

    public function loginForm()
    {
        return Inertia::render('Auth/Login');
    }
    /**
     * Login a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //Consider validating password as well for enhanced security.
            'email' => 'required|email', //Instead of 'name', validate 'email' and 'password' for standard authentication.
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->all();
        if (Auth::attempt($credentials)) {
            //Attempt authentication with email and password.
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']); //Generic error message for security.
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); //Purpose: Generates a new CSRF token. //Why: To prevent Cross-Site Request Forgery (CSRF) attacks.
        return redirect('/login');
    }
}
