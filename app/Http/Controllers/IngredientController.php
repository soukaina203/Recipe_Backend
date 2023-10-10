<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index()
    {
        $items = Ingredient::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Ingredient($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Ingredient::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Ingredient::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Ingredient::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}