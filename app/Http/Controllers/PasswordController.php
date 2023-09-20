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
        
        if ($request->input('password') === $request->input('password_confirmation')){
            $user->update([
                'password' => bcrypt($request->input('password')),
                'password_code' => null,
            ]);
    
            return redirect()->route('login')->with('success', 'Het wachtwoord is succesvol aangemaakt. U kunt nu inloggen.');
        }
        else {
            return redirect()->back()->with('error', 'De gegeven wachtwoorden komen niet overeen!');
        }
    }
}