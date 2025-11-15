<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Explicit table name because "feedback" is an uncountable noun and
    // Eloquent would default to `feedback` which doesn't match our migration.
    protected $table = 'feedbacks';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'message',
        'status',
    ];

    public function replies()
    {
        return $this->hasMany(\App\Models\FeedbackReply::class);
    }
}
