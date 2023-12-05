<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @property string $name
 * @property string $description
 * @porperty int $goal
 * @property string $image
 */
class CollectionEntity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'goal',
        'image',
    ];
}
