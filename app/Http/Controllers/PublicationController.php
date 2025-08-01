<?php

namespace App\Http\Controllers;

use App\Http\Requests\Publication\CreatePublicationRequest;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicationController extends BaseController
{

    public function create(CreatePublicationRequest $request) {
        $validated = $request->validated();
        $name = $validated['name'];
        $description = $validated['description'];
        $user = Auth::user();

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
}
