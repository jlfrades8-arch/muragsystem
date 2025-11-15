<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'actor_id',
        'actor_name',
        'actor_email',
        'action',
        'target_user_id',
        'target_user_name',
        'target_user_email',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
