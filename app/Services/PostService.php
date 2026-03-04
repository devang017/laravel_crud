<?php

namespace App\Services;

use App\Models\Post;
use App\TagService;
use Illuminate\Support\Facades\DB;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Post $postModel, protected TagService $tagservice) {}

    /**
     * Retrieve all posts with their associated user, categories and tags.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAllPosts()
    {
        return $this->postModel->newQuery()->with('user', 'categories', 'tags');
    }

    /**
     * Store a new post.
     *
     * @param array $postData
     * @return void
     */
    public function storePost(array $postData)
    {
        DB::transaction(function () use ($postData) {
            $post = $this->postModel->create($postData);

            $tags = array_map(function ($tag) {
                return ['name' => $tag['value']];
            }, $postData['tags']);

            $this->tagservice->storeTagsBatch($tags);

            $tagsIds = $this->tagservice->getTagIdsFromNames(array_column($tags, 'name'));

            $post->tags()->attach($tagsIds);

            $post->categories()->attach($postData['categories']);
        });
    }
}
