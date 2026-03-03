<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected CategoryService $categoryService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $permissions = $this->categoryService->getAllCategories($request);

        if ($request->ajax()) {
            return $this->initPermissionDataTable($permissions);
        }
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->categoryService->storeCategory($request->validated());
        } catch (\Throwable $e) {
            # code...
        }

        return redirect()->route('categories.index')->with('success', trans('admin.message.created', ['module' => 'Category']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getSingleCategory($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $this->categoryService->updateCategory($request->validated(), $id);
        } catch (\Throwable $e) {
            return redirect()->route('categories.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('categories.index')->with('success', trans('admin.message.updated', ['module' => 'Category']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->categoryService->deleteCategory($id);
        } catch (\Throwable $e) {
            return redirect()->route('categories.index')->with('error', trans('admin.message.something_wrong'));
        }
        return redirect()->route('categories.index')->with('success', trans('admin.message.deleted', ['module' => 'Category']));
    }

    /**
     * Initialize a DataTable with categories data.
     *
     * This function adds an index column and an action column to the DataTable.
     * The action column contains an edit and delete button for each permission.
     *
     * @param object $categories An object containing the categories data.
     * @return \Yajra\DataTables\DataTables The DataTable with the categories data.
     */
    public function initPermissionDataTable(object $categories)
    {
        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('action', function ($permission) {
                $editUrl = route('categories.edit', $permission->id);
                $deleteUrl = route('categories.destroy', $permission->id);
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
