<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Figure extends Model
{
    use SoftDeletes;

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
        'release_date' => 'date:Y-m-d',
    ];
}
