<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\IndexUserRequest;

class UserController extends BaseController
{

    public function index(IndexUserRequest $request) {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $role = $validated['role'] ?? null;
        $perPage = $validated['per_page'] ?? 1000;

        $usersQuery = User::query();

        if(!empty($role)) {
            $usersQuery->where('role', $role);
        }

        if(!empty($search)) {
            // TODO: add courses when implemented
            $usersQuery->where(function($q) use($search) {
                $q->where('user_name', 'like', "%$search%")
                    ->orWhere('nick_name', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        $users = $usersQuery->paginate($perPage);

        return $this->sendResponse([
            'users' => $users
        ], 'Users queried succesfully');
    }
}
