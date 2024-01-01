<?php /** @noinspection ALL */

namespace App\Models;

use App\Enums\CollectionElementStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @mixin Builder
 * @property int $id
 * @property int $collection_entity_id
 * @property string $name
 * @property string $description
 * @property CollectionElementStatus $status
 * @property string $image
 * @property CollectionEntity $entity
 * @property Source[] $sources
 * @method Builder filterElements(array $filters)
 */
class CollectionElement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
    ];

    protected $casts = [
        'status' => CollectionElementStatus::class,
    ];

    public function entity(): BelongsTo
    {
        return $this->belongsTo(CollectionEntity::class, 'collection_entity_id');
    }

    public function sources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class)->withTimestamps();
    }

    public function scopeFilterElements(Builder $query, array $filters)
    {
        if (isset($filters['search']) && $filters['search'] != '') {
            $query->whereRaw("UPPER(name) LIKE '%" . Str::upper($filters['search']) . "%'")
                ->orWhereRaw("UPPER(description) LIKE '%" . Str::upper($filters['search']) . "%'");
        }

        if (isset($filters['source']) && !is_null($filters['source'])) {
            if ($filters['source'] == 0) {
                $query->whereRaw(sprintf("
                    collection_elements.id NOT IN (
                        select distinct(collection_element_source.collection_element_id)
                        from collection_element_source
                        join collection_elements on collection_element_source.collection_element_id = collection_elements.id
                        where collection_elements.collection_entity_id = %d
                    )
                ", $filters['collectionEntityId']));
            }

            if ($filters['source'] > 0) {
                $query->join(
                    'collection_element_source',
                    'collection_elements.id',
                    '=',
                    'collection_element_source.collection_element_id',
                    'inner'
                )
                ->where('collection_element_source.source_id', '=', $filters['source']);
            }
        }
    }
}
