<?php

namespace App\Livewire\Forms;

use App\Http\Requests\StoreSourceRequest;
use App\Models\Source;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class SourceForm extends Form
{
    public string $source;

    /**
     * @throws ValidationException
     */
    public function store(): bool
    {
        $validatedFormFields = $this->validate();

        $source = new Source($validatedFormFields);
        return $source->save();
    }

    public function rules(): array
    {
        return (new StoreSourceRequest())->rules();
    }
}
