<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        $user = User::where('password_code', $code)->first();

        if (!$user || !is_null($user->password)) {
            return redirect()->route('login')->with('error', 'Invalid or expired link.');
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
            'password_code' => null,
        ]);

        return redirect()->route('login')->with('success', 'Password has been set successfully. You can now log in.');
    }

}