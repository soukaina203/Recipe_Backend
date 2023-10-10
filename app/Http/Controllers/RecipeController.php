<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $items = Recipe::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Recipe($request->all());
        $item->save();

        return response()->json($item, 201);
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

        return response()->json(['message' => 'Recipe deleted successfully']);
    }
}