<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Builder
 * @property int $id
 * @property string $name
 * @property CollectionElement[] $elements
 */
class Source extends Model
{
    use HasFactory, SoftDeletes;

    public function elements(): BelongsToMany
    {
        return $this->belongsToMany(CollectionElement::class);
    }
}
