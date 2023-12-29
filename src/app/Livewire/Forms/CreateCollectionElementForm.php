<?php

namespace App\Livewire\Forms;

use App\Http\Requests\StoreCollectionElementRequest;
use App\Models\CollectionElement;
use Illuminate\Validation\ValidationException;

class CreateCollectionElementForm extends CollectionElementForm
{
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
