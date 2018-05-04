<?php

namespace SCF\Http\Controllers\Admin;

use SCF\Models\User;
use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;
use SCF\Http\Requests\UserUpdateRequest;

class UsersController extends Controller
{
    /**
     * Delete a user.
     *
     * @param User $user
     *
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        if (auth()->id() === $user->id) {
            throw new \Exception('Not allowed to delete yourself');
        }

        $user->forceDelete();

        return $this->successResponse();
    }

    /**
     * Edit a user.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUser(User $user = null)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function createUser(UserUpdateRequest $request)
    {

    }

    public function updateUser(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        $user->verified = $request->input('verified') == 1;


    }
}
