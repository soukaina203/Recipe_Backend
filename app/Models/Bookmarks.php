<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',        'recipe_id',
           'user_id',

    ];
}
