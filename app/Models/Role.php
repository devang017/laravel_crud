<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table('roles')]
#[Fillable(['name', 'slug', 'description'])]
class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Retrieve the users associated with this role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id')->withTimestamps();
    }

    /**
     * Retrieves the permissions associated with this role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id')->withTimestamps();
    }

    /**
     * Checks if the role has the given permission.
     *
     * @param string $permissionName The name of the permission to check.
     * @return bool True if the role has the permission, false otherwise.
     */
    public function hasPermission($permissionName)
    {
        return $this->permissions()->contains('name', $permissionName);
    }
}
