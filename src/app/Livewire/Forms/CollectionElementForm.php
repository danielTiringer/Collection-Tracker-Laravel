<?php

namespace App\Livewire\Forms;

use App\Enums\CollectionElementStatus;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use Livewire\Form;
use Livewire\WithFileUploads;

class CollectionElementForm extends Form
{
    use WithFileUploads;

    public CollectionEntity $collection;
    public CollectionElement|null $element = null;
    public string $name;
    public string $description;
    public CollectionElementStatus $status = CollectionElementStatus::PLANNED;
    public int|null $source;
    public $image;

    public function setCollection(CollectionEntity $collection): void
    {
        $this->collection = $collection;
    }

    public function setElement(CollectionElement $element): void
    {
        $this->element = $element;
        $this->name = $element->name;
        $this->description = $element->description;
        $this->status = $element->status;
        $this->source = $element->sources()->first()?->id;
        $this->image = $element->image;
    }
}
