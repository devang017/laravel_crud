<?php

namespace App\Trait;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissionsTrait
{
    /**
     * Retrieve permission models matching the given slugs.
     *
     * @param  array|string  $permission  One or more permission slugs
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[]
     */
    public function getAllPermissions($permission)
    {
        return Permission::whereIn('slug', $permission)->get();
    }

    /**
     * Determine if the model has a direct permission by name.
     *
     * @param  string  $permission  Permission name to check
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    /**
     * Check if the model has any of the given roles.
     *
     * @param  string[]  ...$roles  One or more role names
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine if the model has a given permission either directly
     * or via one of its roles.
     *
     * @param  string|\App\Models\Permission  $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    /**
     * Determine if the model has a permission through any of its roles.
     *
     * @param  string|\App\Models\Permission  $permissions
     * @return bool
     */
    public function hasPermissionThroughRole($permissions)
    {
        foreach ($permissions->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Assign the given permissions to the model.
     *
     * @param  string|\App\Models\Permission  ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null || $permissions->count() == 0) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * Define a many-to-many relationship to the Permission model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id')->withTimestamps();
    }

    /**
     * Define a many-to-many relationship to the Role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}
