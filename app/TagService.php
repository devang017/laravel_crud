<?php

namespace App;

use App\Models\Tag;

class TagService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected Tag $tagModel) {}

    public function storeTagsBatch(array $tags)
    {
        $this->tagModel->upsert($tags, ['name']);
    }

    public function getTagIdsFromNames(array $tagNames)
    {
        return $this->tagModel->whereIn('name', $tagNames)->pluck('id')->toArray();
    }
}
