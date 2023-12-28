<?php

namespace App\Livewire\CollectionElement;

use App\Enums\CollectionElementStatus;
use App\Livewire\Forms\CollectionElementForm;
use App\Models\CollectionEntity;
use App\Models\Source;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCollectionElement extends Component
{
    use WithFileUploads;

    public CollectionEntity $collection;
    public CollectionElementForm $form;
    public Collection $sources;
    /** @var CollectionElementStatus[]  */
    public array $statuses;

    public function mount(CollectionEntity $collection): void
    {
        $this->collection = $collection;
        $this->form->setCollection($collection);
        $this->sources = Source::all();
        $this->statuses = CollectionElementStatus::cases();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function render()
    {
        try {
            $this->authorize('createElement', $this->collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to add element to collection');
        }

        return view('livewire.collection_element.create')
            ->extends('layout')
            ->section('content');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function save()
    {
        try {
            $this->authorize('createElement', $this->collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to add element to collection');
        }

        $elementSaved = $this->form->store();
        if (!$elementSaved) {
            return redirect()
                ->route('collections.show', $this->collection->id)
                ->with('error', 'Element creation failed');
        }

        return redirect()
            ->route('collections.show', $this->collection->id)
            ->with('success', 'Element created successfully');
    }

    #[On('source-added')]
    public function updateSources(): void
    {
        $this->sources = Source::all();
    }
}
