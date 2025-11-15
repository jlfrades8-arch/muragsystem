<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackReply extends Model
{
    protected $table = 'feedback_replies';

    protected $fillable = [
        'feedback_id',
        'admin_id',
        'message',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
