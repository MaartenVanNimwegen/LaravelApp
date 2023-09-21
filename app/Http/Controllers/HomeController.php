<?php
 
namespace App\Http\Controllers;
 
use App\Models\Les_user_koppel;
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

    public function isUserAangemeld($lesId)
    {
        $userId = auth()->user()->id;
        $records = Les_user_koppel::where('userId', $userId)
        ->where('lesId', $lesId)
        ->get();
        if ($records->isEmpty()) {
            return false;
        }
        return true;
    }
}