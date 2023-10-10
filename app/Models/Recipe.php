<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',        'title',        'description',        'instructions',        'cooking_details',        'type',
            'photo','category_id','user_id'
    ];
}
