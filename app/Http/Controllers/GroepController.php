<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Groep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroepController extends Controller
{
    public function index()
    {
        $Groups = Groep::with('users')->get();
        return $Groups;
    }

    public function create()
    {
        $availableUsers = User::whereNotIn('id', function ($query) {
            $query->select('users.id')
                ->from('users')
                ->join('groep_user_koppel', 'users.id', '=', 'groep_user_koppel.userId')
                ->join('groep', 'groep_user_koppel.groepId', '=', 'groep.id')
                ->whereColumn('groep_user_koppel.userId', 'users.id')
                ->where('groep.status', 0);
        })
            ->where('role', '!=', 'admin')
            ->whereNull('password_code')
            ->get();

        return view('createGroup', compact('availableUsers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naam' => 'required|string|max:75',
            'user_ids' => 'array|required|min:1',
        ], [
            'max' => 'Je gekozen naam is te lang!',
            'string' => 'De waarde moet van het type tekst zijn!',
            'array' => 'Het veld wat je hebt ingevuld klopt niet!',
            'min' => 'Het veld mag niet leeg zijn!',
            'required' => 'Alle velden zijn verplicht!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $validatedData = $request->validate([
            'naam' => 'required|string|max:75',
            'user_ids' => 'array|required|min:1',
        ]);

        $groep = new Groep;
        $groep->naam = $validatedData['naam'];
        $groep->status = 0;
        $groep->save();

        if (isset($validatedData['user_ids'])) {
            $groep->users()->attach($validatedData['user_ids']);
        }

        return redirect()->back()->with('success', 'Groep aangemaakt!');

    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return $user->groups;
    }

    public function ArchiveerGroep($id)
    {
        $groep = Groep::findOrFail($id);
        $groep->update(['status' => '1']);

        return redirect()->route('home')->with('success', 'Groep gearchiveerd!');
    }

    public function aanwezig()
    {
        $user = User::find(auth()->user()->id);

        if ($user) {
            if ($user->aanwezig === 1) {
                return redirect()->route('home')->with('success', 'Je bent al aanwezig gemeld!');
            }

            $user->aanwezig = 1;
            $user->save();

            return redirect()->route('home')->with('success', 'Je bent nu aanwezig gemeld!');
        }
        return redirect()->back()->with('error', 'Er is een fout opgetreden!');
    }
}