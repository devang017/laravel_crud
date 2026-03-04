<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected User $userModel) {}

    /**
     * Retrieves a list of all users with their associated roles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllUsers(Request $request)
    {
        return $this->userModel->newQuery()->with('roles');

        // return DB::table('users')
        //     ->select('id', 'name', 'email');
    }

    /**
     * Store a new user with the given data.
     *
     * This function uses a database transaction to store the user and its associated roles.
     * The user is created with the given data and then its roles are updated.
     * The user is then loaded with its associated roles and permissions.
     * The user's permissions are updated to include the unique permissions of all its roles.
     *
     * @param array $userData The user data to store.
     * @return void
     */
    public function storeUser(array $userData)
    {
        DB::transaction(function () use ($userData) {
            $user = $this->userModel->create($userData);
            $user->roles()->attach($userData['roles']);

            $user->load('roles.permissions');
            $permissions = $user->roles->flatMap->permissions->unique('id');

            $user->permissions()->attach($permissions);
        });
    }

    /**
     * Retrieves a single user by its ID.
     *
     * @param string $id The ID of the user to retrieve.
     * @return \App\Models\User The user model.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user is not found.
     */
    public function getSingleUser(string $id)
    {
        return $this->userModel->findOrFail($id);
    }

    /**
     * Updates a user with the given data.
     *
     * This function uses a database transaction to update the user and its associated roles.
     * The user is updated with the given data and then its roles are updated.
     * The user is then loaded with its associated roles and permissions.
     * The user's permissions are updated to include the unique permissions of all its roles.
     *
     * @param array $userData The user data to update.
     * @param string $id The ID of the user to update.
     * @return void
     */
    public function updateUser(array $userData, string $id)
    {
        DB::transaction(function () use ($userData, $id) {
            $user = $this->getSingleUser($id);
            $user->update($userData);
            $user->roles()->sync($userData['roles']);

            $user->load('roles.permissions');
            $permissions = $user->roles->flatMap->permissions->unique('id');
            $user->permissions()->sync($permissions);
        });
    }

    /**
     * Deletes a user by its ID.
     *
     * This function uses a database transaction to delete the user and detach its associated roles and permissions.
     *
     * @param string $id The ID of the user to delete.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user is not found.
     *
     * @return void
     */
    public function deleteUser(string $id)
    {
        DB::transaction(function () use ($id) {
            $user = $this->getSingleUser($id);
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->delete();
        });
    }
}
