<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('categories')]
#[Fillable(['name'])]
class Category extends Model
{
    /**
     * Retrieve the posts associated with this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id')->withTimestamps();
    }
}
