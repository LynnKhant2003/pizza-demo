<?php

namespace App\Http\Controllers;

use Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email',$request->email)->first();
        if(empty($user) || !Hash::check($request->password,$user->password)){
            return Response::Json(
                [
                    'Message'=>"Credential Does not Match"
                ],200
            );
        }
        $token = $user->createToken('myAppToken')->accessToken;
        return Response::Json(
            [
                'user' => $user,
                'token' => $token
            ],200
        );
    }
}
