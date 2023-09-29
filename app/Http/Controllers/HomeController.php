<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index(LesController $lesController, GroepController $groepController)
    {
        $user = auth()->user();

        $upcommingLessons = $lesController->ViewAllComingLessons();

        $groups = $groepController->index();
        $groep = $groepController->show($user->id);
        return view('home', compact('upcommingLessons', 'groups', 'groep'));
    }
}