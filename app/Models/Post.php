<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post', 'post_id', 'tag_id')->withTimestamps();
    }
}
