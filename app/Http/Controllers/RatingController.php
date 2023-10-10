<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index()
    {
        $items = Rating::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Rating($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Rating::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Rating::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Rating::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Rating deleted successfully']);
    }
}