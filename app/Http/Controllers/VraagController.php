<?php

namespace App\Http\Controllers;

use App\Models\Vraag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VraagController extends Controller
{
    public function StelVraag(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'vraag' => ['max:255', 'required', 'string'],
            ],
            [
                'required' => 'Het vragen veld moet worden ingevuld!',
                'max' => 'Je kan maximaal 255 karakters gebruiken!',
                'string' => 'De vraag mag alleen tekst zijn!'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $vraag = new Vraag();
        $vraag->vraag = $request->input('vraag');
        $vraag->userId = auth()->user()->id;

        $vraag->save();
        return back()->with('success', 'Je vraag is gesteld en is terug te zien onder "Door jou gestelde vragen".');
    }

    public function VerwijderVraag($id)
    {
        $vraag = Vraag::find($id);
        if ($vraag) {
            $vraag->delete();
            return redirect()->back()->with('success', 'De vraag is verwijderd!');
        } else {
            return redirect()->back()->with('error', 'Er is een fout opgetreden!');
        }
    }
}