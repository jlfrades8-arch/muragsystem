<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rescue extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'pet_name',
        'address',
        'location',
        'condition',
        'kind',
        'color',
        'contact',
        'status',
        'image',
        'adopter_email',
        'adopter_name',
    ];

    /**
     * Return a public URL for the rescue image, normalizing stored values.
     * If the `image` column already contains a path like "rescues/xxx.jpg",
     * use it; if it contains only a filename, prefix with "rescues/".
     * If image is empty, return null.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return null;
        }

        $path = $this->image;

        // normalize: ensure it includes the rescues/ folder
        if (!str_starts_with($path, 'rescues/')) {
            $path = 'rescues/' . ltrim($path, '/');
        }

        return asset('storage/' . $path);
    }
}
