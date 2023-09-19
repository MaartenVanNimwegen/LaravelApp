<?php

namespace App\Http\Controllers;

use App\Models\Les;
use Illuminate\Http\Request;

class AddLesController extends Controller
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
}   