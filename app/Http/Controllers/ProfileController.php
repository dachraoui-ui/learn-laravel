<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function store(CreateProfileRequest $request)
    {
        $user_id = Auth::user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $user_id; // Set the authenticated user's ID

        if($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('my photo', 'public');
            $validated['profile_picture'] = $path;
        }

        $profile = Profile::create($validated);
        return response()->json(['message' => 'Profile created successfully', 'profile' => $profile], 201);
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
