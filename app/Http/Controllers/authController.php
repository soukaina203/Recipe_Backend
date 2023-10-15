<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{

    public function signup(Request $request)
    {
        $allUsers=User::all();
        $emailToCheck = $request->email;

        if ($allUsers->contains('email', $emailToCheck)) {

          return response()->json("existed");;
        }else{

            $user = new User([
                "name" => $request->name,
                "email" => $request->email,
                "password" =>  Hash::make($request->password),
                "address" => $request->address,
                "phone" => $request->phone,
                'city' => $request->city,
                'photo' => $request->photo,
                'country' => $request->country


            ]);
            $user->save();
            return response()->json("success");
        }

    }
    public function logout()
    {
        try {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete(); // delete the token from the database
            });

            return response()->json('Logged');
        } catch (QueryException $e) {
            // Handle the exception if something goes wrong during token deletion
            return response()->json('An error occurred while logging out', 500);
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Api Token of ' . $user->name)->plainTextToken;

            // $isAdmin = $user->isAdmin === 1 ? 'a' : 'u';

            return response()->json([
                'token' => $token,
                'status' => 'success',
                'message' => 'Login successful',
                'user' => $user,
                // 'isAdmin' => $isAdmin
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
    }



}
