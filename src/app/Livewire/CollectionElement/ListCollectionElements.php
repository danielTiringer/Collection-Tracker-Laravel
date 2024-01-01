<?php

namespace App\Livewire\CollectionElement;

use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Livewire\WithPagination;

class ListCollectionElements extends Component
{
    use WithPagination;

    public CollectionEntity $collection;
    public string $searchQuery = '';

    public function render(): View|Application|Factory|ContractsApplication
    {
        $elements = (new CollectionElement)
            ->where('collection_entity_id', $this->collection->id)
            ->where(function (Builder $query) {
                $query
                    ->whereRaw("UPPER(name) LIKE '%" . Str::upper($this->searchQuery) . "%'")
                    ->orWhereRaw("UPPER(description) LIKE '%" . Str::upper($this->searchQuery) . "%'");
            })
            ->paginate(10);

        return view('livewire.collection-element.list', [
            'elements' => $elements,
        ]);
    }
}
