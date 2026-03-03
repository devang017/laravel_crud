<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{

    function __construct(protected PermissionService $permissionService, protected RoleService $roleService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = $this->permissionService->getAllPermissions($request);
        if ($request->ajax()) {
            return $this->initPermissionDataTable($permissions);
        }

        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getRoleList();
        return view('permission.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            $this->permissionService->storePermissions($request->validated());
        } catch (\Throwable $e) {
            return redirect()->route('permissions.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('permissions.index')->with('success', trans('admin.message.created', ['module' => 'Permission']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $permission = $this->permissionService->getSinglePermission($id);
        } catch (\Throwable $e) {
            return redirect()->route('permissions.index')->with('error', trans('admin.message.something_wrong'));
        }
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $roles = $this->roleService->getRoleList();
            $permission = $this->permissionService->getSinglePermission($id);
        } catch (\Throwable $e) {
            return redirect()->route('permissions.index')->with('error', trans('admin.message.something_wrong'));
        }

        return view('permission.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        try {
            $this->permissionService->updatePermissions($request->validated(), $id);
        } catch (\Throwable $e) {
            return redirect()->route('permissions.index')->with('error', trans('admin.message.something_wrong'));
        }
        return redirect()->route('permissions.index')->with('success', trans('admin.message.updated', ['module' => 'Permission']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->permissionService->deletePermission($id);
        } catch (\Throwable $e) {
            return redirect()->route('permissions.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('permissions.index')->with('success', trans('admin.message.deleted', ['module' => 'Permission']));
    }

    /**
     * Initialize a DataTable with permissions data.
     *
     * This function adds an index column and an action column to the DataTable.
     * The action column contains an edit and delete button for each permission.
     *
     * @param object $permissions An object containing the permissions data.
     * @return \Yajra\DataTables\DataTables The DataTable with the permissions data.
     */
    public function initPermissionDataTable(object $permissions)
    {
        return DataTables::of($permissions)
            ->addIndexColumn()
            ->addColumn('action', function ($permission) {
                $editUrl = route('permissions.edit', $permission->id);
                $deleteUrl = route('permissions.destroy', $permission->id);
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
