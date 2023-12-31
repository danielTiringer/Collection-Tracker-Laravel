<?php

namespace App\Livewire\Forms;

use App\Http\Requests\StoreSourceRequest;
use App\Models\Source;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class SourceForm extends Form
{
    public string $source = '';

    /**
     * @throws ValidationException
     */
    public function store(): bool
    {
        $validatedFormFields = $this->validate();

        $source = new Source($validatedFormFields);
        $sourceSaved = $source->save();
        if ($sourceSaved) {
            $this->reset('source');
        }

        return $sourceSaved;
    }

    public function rules(): array
    {
        return (new StoreSourceRequest())->rules();
    }
}
