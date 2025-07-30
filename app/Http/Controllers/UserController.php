<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);

    }

    public function login(){

    }

    public function logout(){

    }


















    public function getProfile($id){
        $profile = User::find($id)->profile()->firstOrFail();
        return response()->json($profile, 200);
    }

    public function updateProfile($id , UpdateProfileRequest $request){
        $profile = User::find($id)->profile()->firstOrFail();
        $profile->update($request->validated());
        return response()->json($profile, 200);
    }

    public function getUserTasks($id){
        $tasks = User::findOrFail($id)->tasks;
        return response()->json($tasks, 200);
    }
}
