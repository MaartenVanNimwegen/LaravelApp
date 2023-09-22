<?php

namespace App\Http\Controllers;

use App\Models\Vraag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class VraagController extends Controller
{
    public function StelVraag(Request $request)
    {
        $validator = Validator::make($request->input(), ['vraag' => 'required|max:255'], ['vraag' => 'Het vragen veld moet worden ingevuld!',]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $vraag = new Vraag();
        $vraag->vraag = $request->input('vraag');
        $vraag->userId = auth()->user()->id;

        $vraag->save();
        return back()->with('success', 'Je vraag is gesteld!');
    }
}