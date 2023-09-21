<?php
 
 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\Les;
 
 class HomeController extends Controller
 {
     public function index(LesController $lesController, GroepController $groepController)
     {
        $user = auth()->user();

         $upcommingLessons = $lesController->ViewAllComingLessons();
         $groups = $groepController->index();
         $group = $groepController->show($user->id);
 
         return view('home', compact('upcommingLessons', 'groups', 'group'));
     }
 }
 