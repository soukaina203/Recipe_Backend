<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $distinctCities= User::distinct()->pluck('city');
        $distinctCountries= User::distinct()->pluck('country');

        return response()->json([
            'users'=>$users,
            'distinctCities'=>$distinctCities,
            'distinctCountries'=>$distinctCountries
        ]);
    }
    public function uploadImg(Request $request, string $id){
        // $request->validate([
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow jpeg, png, jpg, gif images up to 2MB
        // ]);
        // return response()->json(['img'=> $request->file('image')]);
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $name);
            $user = User::findOrFail($id);
            $user->photo = $name;
            $user->update();
            return ['image_url' => $name];
        }else{
            return "Nothing";
        }
    }

    public function store(Request $request)
    {


        $item = new User($request->all());
        $item->save();

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        return response()->json($item);
    }


    public function update(Request $request, $id)
    {


            $item = User::findOrFail($id);
            $item->name = $request->input('name');
            $item->email = $request->input('email');
            $item->password = Hash::make($request->input('password'));
            $item->city = $request->input('city');
            $item->country = $request->input('country');
           $item->update();
        $item->save();

            return response()->json('great');

    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'deleted']);
    }
}
