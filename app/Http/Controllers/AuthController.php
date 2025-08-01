<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PostLoginRequest;
use App\Http\Requests\Auth\PostRegisterRequest;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends BaseController
{
    public function register(PostRegisterRequest $request)
    {
        $validatedData = $request->validated();

        // image logic
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $profileImagePath = Storage::disk('profile_images')->putFileAs(
                null,
                $file,
                $filename
            );
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'profile_image' => $profileImagePath
        ]);

        return $this->sendResponse(
            ['user' => $user],
            'User registered successfully.'
        );
    }

    public function login(PostLoginRequest $request)
    {
        $validatedData = $request->validated();

        // Attempt to authenticate the user
        if (!Auth::attempt($validatedData)) {
            return $this->sendError(
                'Unauthorized',
                ['error' => ['Invalid email or password.']],
                401
            );
        }

        $user = Auth::user();

        // Generate an access token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return a success response with the token
        return $this->sendResponse(
            [
                'user' => $user,
                'token' => $token,
            ],
            'User logged successfully.'
        );
    }
}
