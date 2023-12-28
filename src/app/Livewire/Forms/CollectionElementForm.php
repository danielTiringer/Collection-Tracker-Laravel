<?php

namespace App\Livewire\Forms;

use App\Enums\CollectionElementStatus;
use App\Http\Requests\StoreCollectionElementRequest;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\WithFileUploads;

class CollectionElementForm extends Form
{
    use WithFileUploads;

    public CollectionEntity $collection;
    public string $name;
    public string $description;
    public CollectionElementStatus $status = CollectionElementStatus::PLANNED;
    public int $source;
    public $image;

    public function setCollection(CollectionEntity $collection): void
    {
        $this->collection = $collection;
    }

    /**
     * @throws ValidationException
     */
    public function store(): bool
    {
        $validatedFormFields = $this->validate();

        if ($this->image) {
            $validatedFormFields['image'] = $this->image->store('images', 'public');
        }

        $element = new CollectionElement($validatedFormFields);
        $element->collection_entity_id = $this->collection->id;

        $elementSaved = $element->save();

        if ($elementSaved && $validatedFormFields['source'] != 0) {
            $element->sources()->attach([$validatedFormFields['source']]);
        }

        return $elementSaved;
    }

    public function rules(): array
    {
        return (new StoreCollectionElementRequest())->rules();
    }
}
