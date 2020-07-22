<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|string',
            'confirmation_password' => 'required|same:password'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = $request->all();
        $user['password'] = Hash::make($request->password);
        $user = User::create($user);
        $access_token = $user->createToken('authToken')->accessToken;
        return response()->json(['access_Token' => $access_token, 'message' => 'User has been created.', 'user' => ['name' => $user->name, 'email' => $user->email]], 201);
    }
}
