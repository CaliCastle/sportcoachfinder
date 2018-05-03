<?php

namespace SCF\Http\Controllers\Admin;

use SCF\Models\User;
use Illuminate\Http\Request;
use SCF\Http\Controllers\Controller;

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

        return ['status' => 'success'];
    }
}
