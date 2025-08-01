<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\PostLoginRequest;
use App\Http\Requests\Auth\PostRegisterRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
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
        } else {
            $profileImagePath = 'user.png';
        }

        $userObj = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'user_name' => $validatedData['user_name'],
            'role' => $validatedData['role'],
            'nick_name' => $validatedData['nick_name'],
            'profile_image' => $profileImagePath
        ];

        $user = User::create($userObj);

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

    public function getUserInfo(Request $request) {
        // Used for validating session

        $user = Auth::user();

        return $this->sendResponse(
            ['user' => $user],
            'User info queried successfully.'
        );
    }
}
