<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $body
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Comment extends Model
{
    protected $fillable = ['body', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     * */

    /*Решил юзать полиморф, т.к. принцип для двух функционалов один и тот же*/
    public function commentable()
    {
        return $this->morphTo();
    }
}
