<?php
use App\Models\Les_user_koppel;
use App\Models\User;
use App\Models\Vraag;

function isUserAangemeld($lesId)
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

function GetLesCount($lesId)
{
    $records = Les_user_koppel::where('lesId', $lesId)->get();
    return count($records);
}

function IsStudentAanwezig($userId)
{
    $record = User::where('id', $userId)->get()->first();

    return $record->aanwezig == 1 ? true : false;
}

function GetAllActiveVragen()
{
    return Vraag::where('status', 0)->get();
}

function GetUsersNameById($id)
{
    $user = User::where('id', $id)->get()->first();
    return $user->name;
}