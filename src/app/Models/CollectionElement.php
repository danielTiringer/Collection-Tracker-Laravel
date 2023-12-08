<?php /** @noinspection ALL */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 * @property int $id
 * @property int $collection_entity_id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class CollectionElement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(CollectionEntity::class, 'collection_entity_id');
    }
}
