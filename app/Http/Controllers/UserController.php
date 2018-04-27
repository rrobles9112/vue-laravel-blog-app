<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\User;

use App\Http\Requests\CreateCustomerRequest;

class UserController extends Controller
{
    public function all()
    {
        $users = User::all();

        return response()->json([
            "users" => $users
        ], 200);
    }

    public function get($id)
    {
        $user = User::whereId($id)->first();
        
        
        return response()->json([
            "user" => $user
        ], 200);
    }

    public function new(CreateUserRequest $request)
    {
        $customer = User::create($request->only(["name", "email", "password"]));

        return response()->json([
            "user" => $customer
        ], 200);
    }

    public function edit(CreateUserRequest $request){

    }
}
