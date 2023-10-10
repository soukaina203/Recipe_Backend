<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe_ingredient;

class Recipe_ingredientController extends Controller
{
    public function index()
    {
        $items = Recipe_ingredient::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Recipe_ingredient($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Recipe_ingredient::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Recipe_ingredient::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Recipe_ingredient::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Recipe_ingredient deleted successfully']);
    }
}