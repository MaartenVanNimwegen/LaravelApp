<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function showPasswordForm(Request $request)
    {
        $code = $request->query('code');

        // Retrieve the user with the given code
        $user = User::where('password_code', $code)->first();

        // Check if the user exists and if the password is null
        if (!$user || !is_null($user->password)) {
            return redirect()->route('login')->with('error', 'Deze link is ongeldig of verlopen.');
        }

        return view('wachtwoord', compact('code'));
    }

    public function setPassword(Request $request)
    {
        $code = $request->input('code');
        $user = User::where('password_code', $code)->first();

        if (!$user || !is_null($user->password)) {
            return redirect()->route('login')->with('error', 'Deze link is ongeldig of verlopen.');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'password' => [
                    Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                    'confirmed',
                    'required',
                    'string'
                ],
            ],
            [
                'password' => 'Je gekozen wachtwoord is niet sterk genoeg! Gebruik minstens een: hoofdletter, kleine letter, symbool, letter, een cijfer en 8 karakters!',
                'confirmed' => 'De gegeven wachtwoorden komen niet overeen!',
                'required' => 'Alle velden zijn verplicht',
                'string' => 'Het wachtwoord kan alleen text zijn!'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
            'password_code' => null,
        ]);

        return redirect('login')->with('success', 'Uw wachtwoord is opgeslagen, u kunt nu inloggen!');
    }

}