<?php

use App\Http\Controllers\authController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

// });
Route::post('signup',[authController::class,'signup']);
Route::post('login',[authController::class,'login']);
Route::post('logout',[authController::class,'logout']);
Route::resource('Users', UserController::class)->except(['create', 'edit']);
Route::resource('Categories', CategoryController::class)->except(['create', 'edit']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('Recipes/FilteredRecipes', [RecipeController::class,'FilteredRecipes']);

    Route::post('Users/img/{id}', [UserController::class,'uploadImg']);
    Route::resource('Recipes', RecipeController::class)->except(['create', 'edit']);
    Route::post('Recipes/img', [RecipeController::class,'uploadImg']);
    Route::get('Recipes/search/{title}', [RecipeController::class,'SearchRecipe']);
    // Route::post('Users/filter', [UserController::class,'filter']);
    Route::resource('Bookmarkss', BookmarksController::class)->except(['create', 'edit']);
    Route::resource('Comments', CommentController::class)->except(['create', 'edit']);
    Route::resource('Ratings', RatingController::class)->except(['create', 'edit']);
    Route::resource('Ingredients', IngredientController::class)->except(['create', 'edit']);
    Route::resource('Recipe_ingredients', Recipe_ingredientController::class)->except(['create', 'edit']);
});
