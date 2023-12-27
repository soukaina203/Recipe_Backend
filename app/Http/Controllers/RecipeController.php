<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    public function index()
    {
        $items = Recipe::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $recipe = new Recipe([
            "title" => $request->input('title'),
            "description" => $request->input('description'),
            "instructions" => $request->input('instructions'),
            "cooking_details" => $request->input('cooking_details'),
            "type" => $request->input('type'),
            "photo" => $request->input('photo'),
            "category_id" => $request->input('category_id'),
            "cooking_time" => $request->input('cooking_time'),
            "user_id" => $request->input('user_id')
        ]);
        $recipe->save();
        return $request;
        return response()->json($recipe, 201);
    }


    public function show($id)
    {
        $item = Recipe::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Recipe::findOrFail($id);

        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Recipe::findOrFail($id);
        $item->delete();
        $items = Recipe::all();
        return response()->json($items);
    }
    public function uploadImg(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif', // Allow jpeg, png, jpg, gif images
            ]);

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $image->move('images/recipes', $name);

                return ['image_url' => $name];
            }

            return response()->json(['error' => 'File not found in request'], 400); // Handle missing file
        } catch (ValidationException $e) {
            return response()->json(['error' => $e], 422); // Handle validation errors
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error($e->getMessage());

            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();

            return response()->json(['error' => [
                'message' => $errorMessage,
                'code' => $errorCode,
            ]], 500);
        }
    }

    public function FilteredRecipes()
    {
        // $distinctCategories = Recipe::distinct()->pluck('category_id');
        $mainRecipes = Recipe::take(9)->get();

        $distinctTypes = Recipe::distinct()->pluck('type');
        $recipesByCookingTime = [
            'lessThan10' =>  Recipe::where('cooking_time', '<=', 10)->get(),
            'lessThan30' =>  Recipe::where('cooking_time', '<=', 30)->get(),
            'greaterThan30' =>  Recipe::where('cooking_time', '>', 30)->get(),
        ];

        $recipesByType = Recipe::orderBy('type')->get()->groupBy('type');
        $recipesByCategories = Recipe::orderBy('category_id')->get()->groupBy('category_id');

        $allCategories = Category::all();
        // return $allCategories;


        return response()->json([
            'mainRecipes'=>$mainRecipes,
            'categoriesGroupes' => $recipesByCategories,
            'recipesByCookingTimeGroupes' => $recipesByCookingTime,
            'distinctTypes' => $distinctTypes,
            'typesGroupes' => $recipesByType,
            'allCategories' => $allCategories

        ]);
    }

    // public function SearchRecipe($title){
    //     $recipes = Recipe::where(function ($query) use ($title) {
    //         $query->where('title', $title);
    //     })->get();
    //     return response()->json($recipes);

    // }
    public function SearchRecipe($title) {
        $recipes = Recipe::where(function ($query) use ($title) {
            $query->whereRaw('LOWER(title) LIKE ?', [strtolower($title)]);
        })->get();
        return response()->json($recipes);
    }

}
