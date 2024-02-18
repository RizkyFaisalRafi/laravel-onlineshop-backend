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


}
