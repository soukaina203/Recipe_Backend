<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categorys'; // Ensure this matches your actual table name in the database


    protected $fillable = [
        'id',        'name',
            'description',

    ];
}
