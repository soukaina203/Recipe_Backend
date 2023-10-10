<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmarks;

class BookmarksController extends Controller
{
    public function index()
    {
        $items = Bookmarks::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Bookmarks($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Bookmarks::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Bookmarks::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Bookmarks::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Bookmarks deleted successfully']);
    }
}