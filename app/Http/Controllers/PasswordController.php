<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showPasswordForm(Request $request)
    {
        $code = $request->query('code');

        // Retrieve the user with the given code
        $user = User::where('password_code', $code)->first();

        // Check if the user exists and if the password is null
        if (!$user || !is_null($user->password)) {
            return redirect()->route('login')->with('error', 'Invalid or expired link.');
        }

        return view('wachtwoord', compact('code'));
    }


    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $code = $request->input('code');

        // Retrieve the user with the given code
        $user = User::where('password_code', $code)->first();

        if (!$user || !is_null($user->password)) {
            return redirect()->route('login')->with('error', 'Deze link is ongeldig of verlopen.');
        }

        // Update the user's password
        $user->update([
            'password' => bcrypt($request->input('password')),
            'password_code' => null,
        ]);

        return redirect()->route('login')->with('success', 'Het wachtwoord is succesvol aangemaakt. U kunt nu inloggen.');
    }
}