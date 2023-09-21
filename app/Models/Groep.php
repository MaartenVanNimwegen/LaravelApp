<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'groep';
    use HasFactory;

    protected $fillable = [
        'naam',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'groep_user_koppel', 'groepId', 'userId');
    }
}