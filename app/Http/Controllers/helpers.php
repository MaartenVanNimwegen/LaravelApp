<?php
use App\Models\Les_user_koppel;

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