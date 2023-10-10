<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $items = Comment::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {


        $item = new Comment($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Comment::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {


        $item = Comment::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Comment::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}