<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function store(CreateProfileRequest $request)
    {
        $profile = Profile::create($request->validated());
        return response()->json($profile,201);
    }

    // this is the show method to retrieve a profile by user ID -> this the first way
    public function show($id){
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return response()->json($profile);
    }

    public function update($id,UpdateProfileRequest $request)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        $profile->update($request->validated());
        return response()->json($profile, 200);
    }
}
