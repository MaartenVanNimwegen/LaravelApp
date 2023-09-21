<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Les;
use App\Models\Les_user_koppel;
use Illuminate\Http\Request;

class LesController extends Controller
{
    public function addLes()
    {
        return view('addLes');
    }

    public function addLesPost(Request $request)
    {
        $les = new Les();

        $les->naam = $request->name;
        $les->info = $request->info;
        $les->klas = $request->klas;
        $les->start = $request->start;
        $les->min = $request->min;
        $les->max = $request->max;

        $now = date('Y-m-d');
        if ($les->start < $now) {
            return back()->with('error', 'Je kan geen les in het verleden plannen!');
        }

        $les->save();

        return back()->with('success', 'De les werd succesvol aangemaakt!');
    }

    public function ViewAllComingLessons()
{
    $currentDate = Carbon::now();

    $upcomingLessons = Les::whereDate('start', '>', $currentDate)
        ->get();

    return $upcomingLessons;
}

    public function Aanmelden(Request $request, $id)
    {
        $userId = auth()->user()->id;

        $records = Les_user_koppel::where('userId', $userId)
        ->where('lesId', $id)
        ->get();
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