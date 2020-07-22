<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\User as UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function currentData()
    {
        return new UserResource(User::findOrFail(Auth::id()));
    }

    /**
     * Update a user.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if(!is_null($request->email)){
            $user->email = $request->email;
        }
        if(!is_null($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        if($user->save()) {
            return new UserResource($user);
        }
    }
}
