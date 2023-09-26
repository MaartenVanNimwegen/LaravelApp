<?php

namespace App\Http\Controllers;

use app\Http\Middleware\AdminMiddleware;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\MiddlewareNameResolver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->input(), ['name' => ['max:70', 'required'], 'email' => ['required', 'max:250'], 'role' => ['required', 'max:7', 'min:5', Rule::in(['admin', 'student'])], 'klas' => ['required', 'max:50'],], ['name.max' => 'De naam mag niet langer zijn dan 70 karakters!', 'email' => 'Het email-adres is te lang. Gebruik maximaal 250 karakters.', 'role' => 'Rol is ongeldig. De rol mag alleen "admin" of "student" zijn!', 'klas' => 'De klas naam mag niet langer zijn dan 50 karakters!', 'required' => 'Alle velden zijn verplicht!',]);

        $userExists = User::where('email', $request->email)->exists();
        if ($userExists) {
            return redirect()->back()->withErrors('Er is al een gebruiker met dit email-adres!');
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

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