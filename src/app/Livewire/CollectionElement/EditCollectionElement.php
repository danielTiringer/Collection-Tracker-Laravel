<?php

namespace App\Livewire\CollectionElement;

use App\Enums\CollectionElementStatus;
use App\Livewire\Forms\EditCollectionElementForm;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\Source;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;

class EditCollectionElement extends Component
{
    use WithFileUploads;

    public CollectionEntity $collection;
    public CollectionElement $element;
    public EditCollectionElementForm $form;
    public Collection $sources;
    /** @var CollectionElementStatus[]  */
    public array $statuses;

    public function mount(CollectionEntity $collection, CollectionElement $element): void
    {
        $this->collection = $collection;
        $this->element = $element;
        $this->form->setCollection($collection);
        $this->form->setElement($element);
        $this->sources = Source::all();
        $this->statuses = CollectionElementStatus::cases();
    }

    public function render()
    {
        try {
            $this->authorize('update', $this->element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit element');
        }

        return view('livewire.collection-element.edit')
            ->extends('layout')
            ->section('content');
    }

    /**
     * @throws ValidationException
     */
    public function edit(): RedirectResponse|Redirector
    {
        try {
            $this->authorize('update', $this->element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit element');
        }

        $elementUpdated = $this->form->update();
        if (!$elementUpdated) {
            return redirect()
                ->route('elements.show', [
                    'collection' => $this->collection,
                    'element' => $this->element,
                ])
                ->with('error', 'Element update failed');
        }


        return redirect()
            ->route('elements.show', [
                'collection' => $this->collection,
                'element' => $this->element,
            ])
            ->with('success', 'Element updated successfully');
    }
}
