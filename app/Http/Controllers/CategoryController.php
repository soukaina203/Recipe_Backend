<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $items = Category::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Category($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Category::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Category::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}