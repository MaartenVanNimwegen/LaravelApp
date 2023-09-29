<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'name' => ['max:70', 'required', 'string'],
                'email' => ['required', 'max:250', 'email'],
                'role' => ['required', 'max:7', 'min:5', Rule::in(['admin', 'student'])],
                'klas' => ['required', 'max:50', 'string'],
            ],
            [
                'name.max' => 'De naam mag niet langer zijn dan 70 karakters!',
                'email.max' => 'Het email-adres is te lang. Gebruik maximaal 250 karakters.',
                'role' => 'Rol is ongeldig. De rol mag alleen "admin" of "student" zijn!',
                'klas' => 'De klas naam mag niet langer zijn dan 50 karakters!',
                'required' => 'Alle velden zijn verplicht!',
                'string' => 'De waarde moet van het type tekst zijn!',
                'email.email' => 'Gebruik een geldig email-adres'
            ]
        );

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

        $result = $this->sendEmail($user);
        if ($result) {
            $user->save();
            return redirect()->back()->with('success', 'De grbruiker is succesvol aangemaakt en heeft een mail ontvangen!');
        }
        return redirect()->back()->with('error', 'Er is geen gebruiker aangemaakt omdat er een fout optrad bij het versturen van de registratiemail!');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'email' => ['required', 'max:250', 'email'],
                'password' => ['required', 'string'],
            ],
            [
                'name.max' => 'De naam mag niet langer zijn dan 70 karakters!',
                'email.max' => 'Het email-adres is te lang. Gebruik maximaal 250 karakters.',
                'role' => 'Rol is ongeldig. De rol mag alleen "admin" of "student" zijn!',
                'klas' => 'De klas naam mag niet langer zijn dan 50 karakters!',
                'required' => 'Alle velden zijn verplicht!',
                'string' => 'De waarde moet van het type tekst zijn!',
                'email' => 'Gebruik een geldig email-adres',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

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

    public function sendEmail($user)
    {
        try {
            Mail::to($user->email)
                ->send(new RegisterMail($user));
            return true;
        } catch (\Exception $e) {
            Log::error('Er is een fout opgetreden bij het versturen van de registratie mail: ' . $e->getMessage());
            return false;
        }
    }
}