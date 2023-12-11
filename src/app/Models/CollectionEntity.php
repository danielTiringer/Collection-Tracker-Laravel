<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property int $goal
 * @property string $image
 * @property CollectionElement[] $elements
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function elements(): HasMany
    {
        return $this->hasMany(CollectionElement::class, 'collection_entity_id');
    }
}
