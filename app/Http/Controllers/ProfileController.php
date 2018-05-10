<?php

namespace SCF\Http\Controllers;

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
            UserAvatar::store($file, $request->user());

            return $this->successResponse();
        }

        return $this->errorResponse();
    }

    /**
     * Update essential info for user.
     *
     * @param Request $request
     *
     * @return array
     */
    public function updateEssentialInfo(Request $request)
    {
        $this->validate($request, [
            'sport'       => 'required|exists:sports,name',
            'zipcode'     => 'required|numeric',
            'mobile'      => 'required|max:15',
            'dateOfBirth' => 'date_format:Y-m-d',
            'gender'      => 'in:none,male,female,trans'
        ]);

        return $this->successResponse();
    }
}
