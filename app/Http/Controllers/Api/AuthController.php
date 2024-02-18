<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Validate the request
        $validated = $request -> validate([
            'name'  => 'required|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password'  => 'required|max:50',
            'phone' => 'required',
            'roles'  => 'required',

        ]);

        // Password encryption
        $validated['password'] = Hash::make( $validated['password'] );

        $user = User::create($validated);

        $token = $user -> createToken('auth_token')->plainTextToken;
        return response() -> json([
            'access_token' => $token,
            'user' => $user,
        ],201);
    }

    // Logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return  response()->json(['message'=>'Logged out Success'],200);
    }

    // login
    public function login(Request $request){

        // Validate the Request
        $validated= $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email', $validated[ 'email' ])->first();

        // if (!$user || !Hash::check($validated['password'], $user->password)) {
        //     return response() -> json(['error'=>'Unauthorized'],401);
        // }

        if(!$user) {
            return response()->json([
                "message" => "User not found"
            ],  404);
        }

        if(!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                "message" => "Invalid Credentials / User Not Found"
            ],  401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['user'=>$user,'access_token'=>$token],200);
    }


}
