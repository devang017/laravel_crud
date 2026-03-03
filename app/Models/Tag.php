<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tag_post', 'tag_id', 'post_id')->withTimestamps();
    }
}
