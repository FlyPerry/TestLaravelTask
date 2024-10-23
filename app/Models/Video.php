<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * */
class Video extends Model
{
    protected $fillable = ['title', 'url', 'user_id'];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
