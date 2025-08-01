<?php

namespace App\Http\Controllers;

use App\Http\Requests\Publication\CreatePublicationRequest;
use App\Http\Requests\User\IndexUserRequest;
use App\Models\Publication;
use App\Models\User;
use App\Models\UserFollow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends BaseController
{

    public function create(CreatePublicationRequest $request) {
        $validated = $request->validated();
        $name = $validated['name'];
        $description = $validated['description'];
        $user = Auth::user();

        if($user->role != User::TEACHER_ROLE) {
            return $this->sendError('Invalid role', [
                'error' => ['Only teachers can create publications']
            ]);
        }

        $profileImagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $profileImagePath = Storage::disk('publication_images')->putFileAs(
                null,
                $file,
                $filename
            );
        }

        $publication = Publication::create([
            'author_id' => $user->id,
            'name' => $name,
            'description' => $description,
            'image' => $profileImagePath
        ]);

        return $this->sendResponse([
            'publication' => $publication
        ], 'Publication created successfully');
    }

    public function index(IndexUserRequest $request) {
        $validated = $request->validated();

        $search = $validated['search'] ?? null;
        $perPage = $validated['per_page'] ?? 1000;

        $user = Auth::user();


        $publicationsQuery = Publication::query();

        // get all post of the teachers user is suscribed

        if($user->role == User::STUDENT_ROLE) {
            $userSubscriptions = UserFollow::where('student_id', $user->id)->get()->pluck('teacher_id');
            $publicationsQuery->whereIn('author_id', $userSubscriptions);
        }

        if(!empty($search)) {
            $publicationsQuery->where(function($q) use($search) {
                $q->where('description', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            });
        }

        $publications = $publicationsQuery->paginate($perPage);

        return $this->sendResponse([
            'publications' => $publications
        ], 'Publications queried succesfully');
    }
}
