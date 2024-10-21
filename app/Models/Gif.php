<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gif extends Model
{
     /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory;
    protected $fillable = [
        'id',
        'alias',
        'user_id',
    ];
}
