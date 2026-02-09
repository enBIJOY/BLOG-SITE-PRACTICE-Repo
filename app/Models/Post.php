<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'slug',
        'image',
        'excerpt',
        'published'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function allComments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Get featured image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-blog.jpg');
    }

    // Get excerpt from content if not set
    public function getExcerptOrGeneratedAttribute()
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }
        return Str::limit(strip_tags($this->content), 200);
    }

}
