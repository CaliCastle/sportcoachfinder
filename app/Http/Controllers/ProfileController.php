<?php

namespace SCF\Http\Controllers;

use Storage;
use SCF\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ProfileController extends Controller
{
    /**
     * Upload an avatar.
     *
     * @param Request $request
     *
     * @return array
     */
    public function uploadAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image'
        ]);

        $file = $request->file('avatar');

        if ($file instanceof UploadedFile) {
            // Configure file name, {user_id}_{time}.{ext}
            $fileName = $request->user()->id . '_' . time() . '.' . $file->clientExtension();
            // Save file to storage in `avatars` directory
            $file->storePubliclyAs('public/'. UserAvatar::PATH, $fileName);
            // Persist into database
            $attributes = [
                'src' => $fileName,
                'type'   => UserAvatar::LOCAL
            ];
            // Create or update
            if ($request->user()->avatar instanceof UserAvatar) {
                // Delete old avatar
                Storage::delete(UserAvatar::PATH . '/' . $request->user()->avatar->src);
                // Update to the new one
                $request->user()->avatar()->update($attributes);
            } else {
                $request->user()->avatar()->create($attributes);
            }

            return $this->successResponse();
        }

        return $this->errorResponse();
    }
}
