<?php

namespace App\Http\Controllers;

use app\Http\Middleware\AdminMiddleware;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\MiddlewareNameResolver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->klas = $request->klas;
        $user->password_code = uuid_create();

        $user->save();

        return back()->with('success', 'Registratie succesvol');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            return redirect('/home');
        }

        return back()->with('error', 'De combinatie van het e-mailadres en het wachtwoord is niet bij ons bekend.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function wachtwoord()
    {
        return view('wachtwoord');
    }
}