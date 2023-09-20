<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Les;
 
class HomeController extends Controller
{
    public function index()
    {
        $lesController = new LesController();
        $upcommingLessons = $lesController->ViewAllComingLessons();
        return view('home', compact('upcommingLessons'));
    }
}