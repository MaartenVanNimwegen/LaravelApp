<?php

namespace App\Http\Controllers;

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
    { {
            $allLessons = Les::all();
            $upcommingLessons = [];
            $currentDate = date('Y-m-d');
            foreach ($allLessons as $lesson) {
                if ($lesson->start > $currentDate) {
                    $upcommingLessons[] = $lesson;
                }
            }
            return $upcommingLessons;
        }
    }
}