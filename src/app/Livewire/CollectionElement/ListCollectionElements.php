<?php

namespace App\Livewire\CollectionElement;

use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\Source;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Livewire\WithPagination;

class ListCollectionElements extends Component
{
    use WithPagination;

    public CollectionEntity $collection;
    public string $searchQuery = '';
    public ?int $sourceDropdown = null;

    public function render(): View|Application|Factory|ContractsApplication
    {
        $elements = (new CollectionElement)
            ->filterElements([
                'search' => $this->searchQuery,
                'source' => $this->sourceDropdown,
                'collectionEntityId' => $this->collection->id,
            ])
            ->where('collection_entity_id', $this->collection->id)
            ->select([
                'collection_elements.id',
                'collection_elements.name',
                'collection_elements.description',
                'collection_elements.image',
                'collection_elements.status',
                'collection_elements.collection_entity_id',
            ])
            ->paginate(10);

        return view('livewire.collection-element.list', [
            'elements' => $elements,
            'sources' => Source::all(),
        ]);
    }

    public function resetFields(): void
    {
        $this->searchQuery = '';
        $this->sourceDropdown = null;
    }
}
