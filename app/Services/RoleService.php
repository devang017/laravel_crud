<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Role $roleModel) {}

    /**
     * Retrieves a list of all roles with their associated permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllRoles(Request $request)
    {
        return $this->roleModel->newQuery()->with('permissions');
    }

    /**
     * Stores a new role with the given data.
     *
     * This function uses a database transaction to store the role and its associated permissions.
     *
     * @param array $requestData The role data to store.
     * @return void
     */
    public function storeRole(array $requestData)
    {
        DB::transaction(function () use ($requestData) {
            $role = $this->roleModel->create($requestData);
            $role->permissions()->attach($requestData['permissions']);
        });
    }

    /**
     * Retrieve a single role by its ID.
     *
     * @param string $id The ID of the role to retrieve.
     * @return \App\Models\Role The role model.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the role is not found.
     */
    public function getSingleRole(string $id)
    {
        return $this->roleModel->findOrFail($id);
    }

    /**
     * Updates a role with the given data.
     *
     * This function uses a database transaction to update the role and its associated permissions.
     *
     * @param string $id The ID of the role to update.
     * @param array $requestData The role data to update.
     *
     * @return void
     */
    public function updateRole(string $id, array $requestData)
    {
        DB::transaction(function () use ($id, $requestData) {
            $role = $this->getSingleRole($id);
            $role->update($requestData);
            $role->permissions()->sync($requestData['permissions']);
        });
    }

    /**
     * Deletes a role by its ID.
     *
     * This function uses a database transaction to delete the role and detach its associated permissions.
     *
     * @param string $id The ID of the role to delete.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the role is not found.
     *
     * @return void
     */
    public function deleteRole(string $id)
    {
        DB::transaction(function () use ($id) {
            $role = $this->getSingleRole($id);
            $role->permissions()->detach();
            $role->delete();
        });
    }

    /**
     * Retrieves a list of roles with their IDs and names.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoleList()
    {
        return $this->roleModel->newQuery()->select('id', 'name')->get();
    }
}
