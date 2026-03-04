<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    function __construct(protected PostService $postService, protected CategoryService $categoryService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $postsData = $this->postService->getAllPosts($request);
            return $this->initPostsDataTable($postsData);
        }

        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getCategoryList();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        try {
            $requestData = $request->validated() + ['user_id' => auth()->id()];
            $this->postService->storePost($requestData);
        } catch (\Throwable $e) {
            return redirect()->route('posts.index')->with('error', trans('admin.message.something_wrong'));
        }

        return redirect()->route('posts.index')->with('success', trans('admin.message.created'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function initPostsDataTable(object $postsData)
    {
        return DataTables::of($postsData)
            ->addIndexColumn()
            ->addColumn('categories', function ($postsData) {
                return $postsData->categories->isNotEmpty() ? $postsData->categories->pluck('name')->implode(', ') : '-';
            })
            ->addColumn('tags', function ($postsData) {
                return $postsData->tags->isNotEmpty() ? $postsData->tags->pluck('name')->implode(', ') : '-';
            })
            ->addColumn('action', function ($postsData) {
                $editUrl = route('categories.edit', $postsData->id);
                $deleteUrl = route('categories.destroy', $postsData->id);
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
