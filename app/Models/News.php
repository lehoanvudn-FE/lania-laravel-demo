<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image_url',
        'category',
        'author',
        'published_at',
        'views',
        'likes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'views' => 'integer',
            'likes' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
