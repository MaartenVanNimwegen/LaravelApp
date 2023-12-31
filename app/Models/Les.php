<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Les extends Model
{
    use HasFactory;

    protected $table = 'les';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'naam',
        'info',
        'klas',
        'start',
        'min',
        'max',
    ];
}
