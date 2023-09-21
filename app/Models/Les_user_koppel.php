<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Les_user_koppel extends Model
{
    use HasFactory;
    protected $table = 'les_user_koppel';
    protected $fillable = [
        'userId',
        'lesId',
    ];
}