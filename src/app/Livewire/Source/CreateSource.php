<?php

namespace App\Livewire\Source;

use App\Livewire\Forms\SourceForm;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateSource extends Component
{
    public SourceForm $form;

    public function render(): View|Application|Factory|ContractsApplication
    {
        return view('livewire.source.create-source');
    }

    /**
     * @throws ValidationException
     */
    public function save()
    {
        $sourceSaved = $this->form->store();
        if ($sourceSaved) {
            $this->dispatch('source-added');
        }
    }
}
