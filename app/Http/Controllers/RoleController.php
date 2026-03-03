<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    function __construct(protected RoleService $roleService, protected PermissionService $permissionService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = $this->roleService->getAllRoles($request);
        if ($request->ajax()) {
            return $this->initRoleDataTable($roles);
        }

        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionService->getPermissionList();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $this->roleService->storeRole($request->validated());
        } catch (\Throwable $e) {
            return redirect()->route('roles.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('roles.index')->with('success', trans('admin.message.created', ['module' => 'Role']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->roleService->getSingleRole($id);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->roleService->getSingleRole($id);
        $permissions = $this->permissionService->getPermissionList();
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            $this->roleService->updateRole($id, $request->validated());
        } catch (\Throwable $e) {
            return redirect()->route('roles.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('roles.index')->with('success', trans('admin.message.updated', ['module' => 'Role']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->roleService->deleteRole($id);
        } catch (\Throwable $e) {
            return redirect()->route('roles.index')->with('error', trans('admin.message.something_wrong'));
        }
        return redirect()->route('roles.index')->with('success', trans('admin.message.deleted', ['module' => 'Role']));
    }

    public function initRoleDataTable(object $roles)
    {
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('permissions', function ($role) {
                return $role->permissions->isNotEmpty() ? $role->permissions->pluck('name')->implode(', ') : '-';
            })
            ->addColumn('action', function ($role) {
                $editUrl = route('roles.edit', $role->id);
                $deleteUrl = route('roles.destroy', $role->id);
                return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
