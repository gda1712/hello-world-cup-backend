<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFollow\AddUserFollowRequest;
use App\Models\User;
use App\Models\UserFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserFollowController extends BaseController
{
    public function addUserFollow(AddUserFollowRequest $request) {
        try {

            $user = Auth::user();

            if($user->role != User::STUDENT_ROLE) {
                return $this->sendError('Error', [
                    'error' => ['Only user profiles can follow teachers']
                ]);
            }


            $validated = $request->validated();
            $teacherId = $validated['teacher_id'];

            // The existence is validated in request
            $teacher = User::where('id', $teacherId)->first();

            if($teacher->role != User::TEACHER_ROLE) {
                return $this->sendError('Error', [
                    'error' => ['Only teacher profiles can be followed']
                ]);
            }

            UserFollow::create([
                'student_id' => $user->id,
                'teacher_id' => $teacherId
            ]);

            return $this->sendResponse([], 'User followed correctly');

        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->sendError('Error', [
                'error' => ['Error following user, contact with admin']
            ]);
        }
    }
}
