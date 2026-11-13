<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
    ];

    public function getReadTimeAttribute(): int
    {
        $text = trim(strip_tags($this->content));
        $words = $text === '' ? 0 : count(preg_split('/\s+/u', $text));

        return max(1, (int) ceil($words / 200));
    }

    public function getHtmlContentAttribute(): string
    {
        return Str::markdown($this->content);
    }
}
