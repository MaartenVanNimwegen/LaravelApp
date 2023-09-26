<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Les;
use App\Models\Les_user_koppel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LesController extends Controller
{
    public function addLes()
    {
        return view('addLes');
    }

    public function addLesPost(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'name' => ['max:70', 'required', 'string'],
                'info' => ['required', 'max:255', 'string'],
                'klas' => ['required', 'max:255', 'string'],
                'min' => ['required', 'between:1,50', 'numeric', 'string'],
                'max' => ['required', 'between:1,200', 'numeric', 'string'],
                'start' => ['required', 'after:today', 'date', 'string'],
            ],
            [
                'name.max' => 'De naam mag niet langer zijn dan 70 karakters!',
                'max' => 'U mag bij :attribute maximaal :max karakters gebruiken!',
                'min.between' => 'Het minimale aantal leerlingen moet liggen tussen :min en :max!',
                'max.between' => 'Het maximale aantal leerlingen moet liggen tussen :min en :max!',
                'numeric' => 'In veld :attribute mogen alleen cijfers ingevuld worden!',
                'required' => 'Alle velden zijn verplicht!',
                'date' => 'De waarde moet een geldige datum zijn',
                'after' => 'Je kan alleen in de toekomst plannen',
                'string' => 'De waarde moet van het type tekst zijn!'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $les = new Les();

        $les->naam = $request->name;
        $les->info = $request->info;
        $les->klas = $request->klas;
        $les->start = $request->start;
        $les->min = $request->min;
        $les->max = $request->max;
        $les->save();

        return back()->with('success', 'De les werd succesvol aangemaakt!');
    }

    public function ViewAllComingLessons()
    {
        $currentDate = Carbon::now();

        $upcomingLessons = Les::whereDate('start', '>', $currentDate)
            ->orderBy('start', 'asc')
            ->get();

        return $upcomingLessons;
    }

    public function Aanmelden(Request $request, $id)
    {
        $les = Les::find($id);
        if (!$les) {
            return redirect()->back()->with('error', 'Er is iets fout gegaan!');
        }

        $userId = auth()->user()->id;

        $records = Les_user_koppel::where('userId', $userId)
            ->where('lesId', $id)
            ->get();

        if ($les->max <= count($records)){
            return redirect()->back()->with('error', 'Deze les is al vol!');
        }

        if ($records->isEmpty()) {
            $les_user_koppel = new Les_user_koppel();
            $les_user_koppel->userId = $userId;
            $les_user_koppel->lesId = $id;
            $les_user_koppel->save();

            return redirect()->route('home');
        }

        return redirect()->route('home')->with('error', 'Je bent al aangemeld voor deze les!');
    }

}