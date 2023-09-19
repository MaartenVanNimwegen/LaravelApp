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
        $les->start = $request->start;
        $les->min = $request->min;
        $les->max = $request->max;

        $les->save();

        return back()->with('success', 'Les added successfully');
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