<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'rescue_id',
        'adopter_name',
        'adopter_email',
        'adopted_at',
        'photo',
    ];

    public function rescue()
    {
        return $this->belongsTo(Rescue::class);
    }
}
