<?php

use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Recipe_ingredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('Users', UserController::class)->except(['create', 'edit']);

Route::resource('Recipes', RecipeController::class)->except(['create', 'edit']);
Route::resource('Categorys', CategoryController::class)->except(['create', 'edit']);
Route::resource('Bookmarkss', BookmarksController::class)->except(['create', 'edit']);
Route::resource('Comments', CommentController::class)->except(['create', 'edit']);

Route::resource('Ratings', RatingController::class)->except(['create', 'edit']);
Route::resource('Ingredients', IngredientController::class)->except(['create', 'edit']);
Route::resource('Recipe_ingredients', Recipe_ingredientController::class)->except(['create', 'edit']);
