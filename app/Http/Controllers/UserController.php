<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    function __construct(protected UserService $userService, protected RoleService $roleService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers($request);
        if ($request->ajax()) {
            return $this->initUsersDataTable($users);
        }

        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getRoleList();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->storeUser($request->validated());
        } catch (\Throwable $e) {
            return redirect()->route('users.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->userService->getSingleUser($id);
        } catch (\Throwable $e) {
            return redirect()->route('users.index')->with('error', trans('admin.message.something_wrong'));
        }
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user = $this->userService->getSingleUser($id);
            $roles = $this->roleService->getRoleList();
        } catch (\Throwable $e) {
            return redirect()->route('users.index')->with('error', trans('admin.message.something_wrong'));
        }

        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        // dd($user->hasPermission('create_author'));
        // dd($user->hasRole('admin'));

        try {
            $this->userService->updateUser($request->validated(), $id);
        } catch (\Throwable $e) {
            return redirect()->route('users.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userService->deleteUser($id);
        } catch (\Throwable $e) {
            return redirect()->route('users.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function initUsersDataTable(object $users)
    {
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return $user->roles->isNotEmpty() ? $user->roles->pluck('name')->implode(', ') : '-';
            })
            ->addColumn('action', function ($user) {
                $editUrl = route('users.edit', $user->id);
                $deleteUrl = route('users.destroy', $user->id);
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
