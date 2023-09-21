<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Les;
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
        // $id contains the ID of the lesson clicked
        // Your controller logic goes here
        // You can access request data using $request

        // For example, you can return a redirect response
        return redirect()->route('home')->with('success', 'Controller method called for lesson with ID ' . $id);
    }

}