<?php

namespace SCF\Http\Controllers\Admin;

use Hash;
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
        $user = User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        if ($user instanceof User) {
            $user->verified = $request->input('verified') == true;
            $user->assignRole($request->input('role'));

            $user->save();

            return $this->successResponse([
                'redirect' => route('admin.users')
            ]);
        }

        return $this->errorResponse();
    }

    /**
     * Update the user.
     *
     * @param UserUpdateRequest $request
     * @param User              $user
     *
     * @return array
     */
    public function updateUser(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        $user->verified = $request->input('verified') == true;
        $user->assignRole($request->input('role'));

        $user->save();

        return $this->successResponse('User updated');
    }
}
