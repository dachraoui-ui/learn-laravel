<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($user->email)->send(new WelcomeMail($user));

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);

    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = User::where('email', $request->email)->FirstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' =>
        'Login Successfully',
         'user' => $user,
         'token' => $token]
         , 201);


    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
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


    public function GetUser(){
        $user_id = Auth::user()->id;
        $userData = User::with('profile')->findOrFail($user_id);
        return new UserResource($userData);
    }

    public function getAllUsers(){
        $userData = User::with('profile')->get();
        return UserResource::collection($userData);
    }


}



















