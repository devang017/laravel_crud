<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Category $categoryModel) {}

    /**
     * Retrieves a list of all categories from the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     *
     * @return \Illuminate\Database\Eloquent\Builder The category query builder.
     */
    public function getAllCategories(Request $request)
    {
        return $this->categoryModel->newQuery();
    }

    /**
     * Stores a new category in the database.
     *
     * @param array $categoryData The category data to store.
     *
     * @return void
     */
    public function storeCategory(array $categoryData)
    {
        $this->categoryModel->create($categoryData);
    }

    /**
     * Retrieves a single category by its ID.
     *
     * @param string $id The ID of the category to retrieve.
     * @return \App\Models\Category The category model.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the category is not found.
     */
    public function getSingleCategory(string $id)
    {
        return $this->categoryModel->findOrFail($id);
    }

    /**
     * Update an existing category.
     *
     * @param array $categoryData The data to update the category with.
     * @param string $id The id of the category to update.
     * @return void
     */
    public function updateCategory(array $categoryData, string $id)
    {
        $category = $this->getSingleCategory($id);
        $category->update($categoryData);
    }

    public function deleteCategory(string $id)
    {
        $category = $this->getSingleCategory($id);
        $category->posts()?->detach();
        $category->delete();
    }

    /**
     * Retrieves a list of all categories with their IDs and names.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategoryList()
    {
        return $this->categoryModel->select('id', 'name')->get();
    }
}
