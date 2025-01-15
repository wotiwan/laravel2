<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'content', 'category_id', 'is_published', 'scheduled_publish_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
