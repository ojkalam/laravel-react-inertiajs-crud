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
        return Inertia::render("Auth/Register");
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
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
        ]);
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)->withInput();
        }
        $user = User::create($request->validated());
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
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator)->withInput(); //withInput option to keep old input
        }
        if (Auth::attempt($validator->valildated())){
            $request->session()->regenerate(); //Purpose: Generates a new session ID. //Why: To prevent session fixation attacks.
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentails does not match our records.'
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); //Purpose: Generates a new CSRF token. //Why: To prevent Cross-Site Request Forgery (CSRF) attacks.
        return redirect('/');
    }

}
