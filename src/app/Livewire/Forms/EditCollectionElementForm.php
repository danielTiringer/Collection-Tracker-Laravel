<?php

namespace App\Livewire\Forms;

use App\Http\Requests\UpdateCollectionElementRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EditCollectionElementForm extends CollectionElementForm
{
    /**
     * @throws ValidationException
     */
    public function update(): bool
    {
        $validatedFormFields = $this->validate();
        if ($this->image) {
            if ($this->element->image) {
                $oldImageRemoved = Storage::disk('public')->delete($this->element->image);
                if (!$oldImageRemoved) {
                    return false;
                }
            }

            $newImage = $this->image->store('images', 'public');
            if (!$newImage) {
                return false;
            }

            $validatedFormFields['image'] = $newImage;
        }


        $elementUpdated = $this->element->update($validatedFormFields);
        if (!$elementUpdated) {
            return false;
        }

        $elementHasSource = $this->element->sources()->exists();

        if ($validatedFormFields['source'] != 0) {
            if (!$elementHasSource) {
                $this->element->sources()->attach([$validatedFormFields['source']]);
            } else {
                $this->element->sources()->sync([$validatedFormFields['source']]);
            }
        }

        if ($validatedFormFields['source'] == 0 && $elementHasSource) {
            $this->element->sources()->sync([]);
        }

        return true;
    }

    public function rules(): array
    {
        return (new UpdateCollectionElementRequest())->rules();
    }
}
