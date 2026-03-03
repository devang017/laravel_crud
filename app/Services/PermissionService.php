<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class PermissionService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private Permission $permissionModel) {}

    /**
     * Retrieve all permissions from the database.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllPermissions(Request $request)
    {
        return $this->permissionModel->newQuery();
    }


    /**
     * Store a new permission in the database.
     *
     * @param array $permissions The permission data to store.
     * @return void
     */
    public function storePermissions(array $permissions)
    {
        DB::transaction(function () use ($permissions) {
            $permission = $this->permissionModel->create($permissions);
            $permission->roles()->attach($permissions['roles']);
        });
    }

    /**
     * Retrieve a single permission by its ID.
     *
     * @param string $id The ID of the permission to retrieve.
     * @return \App\Models\Permission The permission model.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the permission is not found.
     */
    public function getSinglePermission(string $id)
    {
        return $this->permissionModel->with('roles')->findOrFail($id);
    }

    /**
     * Update the specified permission.
     *
     * @param array $permissions
     * @param string $id
     * @return void
     */
    public function updatePermissions(array $permissions, string $id)
    {
        DB::transaction(function () use ($permissions, $id) {
            $permission = $this->getSinglePermission($id);
            $permission->update($permissions);
            $permission->roles()->sync($permissions['roles']);
        });
    }

    /**
     * Deletes a permission by its ID.
     *
     * @param string $id The ID of the permission to delete.
     *
     * @throws \Exception If the permission is not found.
     *
     * @return void
     */
    public function deletePermission(string $id)
    {
        DB::transaction(function () use ($id) {
            $permission = $this->getSinglePermission($id);
            $permission->roles()->detach();
            $permission->delete();
        });
    }

    public function getPermissionList()
    {
        return $this->permissionModel->select('id', 'name')->get();
    }
}
