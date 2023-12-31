<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe_ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',        'recipe_id',        'ingredient_id',
    ];
}