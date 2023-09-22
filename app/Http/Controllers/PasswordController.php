<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;

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

        $validator = Validator::make($request->all(), [
            'password' => [
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                'confirmed',
                'required',
            ],
        ], [
            'password' => 'Je gekozen wachtwoord is niet sterk genoeg! Gebruik minstens een: hoofdletter, kleine letter, symbool, letter en een cijfer!',
            'confirmed' => 'De gegeven wachtwoorden komen niet overeen!',
            'required' => 'Alle velden zijn verplicht'
        ]);

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