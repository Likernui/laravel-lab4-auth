<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Figure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'height_cm',
        'material',
        'short_description',
        'full_description',
        'release_date',
        'image',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    /**
     * Готовый URL для картинки.
     * Если файла нет — placeholder.png из public/images.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            $path = public_path('storage/' . $this->image);
            if (file_exists($path)) {
                return asset('storage/' . $this->image);
            }
        }

        // Файл не найден или image = null
        return asset('images/placeholder.png');
    }
}
