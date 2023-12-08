<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionElementRequest;
use App\Http\Requests\UpdateCollectionElementRequest;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CollectionElementController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(CollectionEntity $collection): View|Application|Factory|ContractsApplication|RedirectResponse
    {
        try {
            $this->authorize('createElement', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to add element to collection');
        }

        return view('collection_element.create', [
            'collection' => $collection,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionElementRequest $request, CollectionEntity $collection): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->authorize('createElement', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to add element to collection');
        }

        $validatedFormFields = $request->validated();

        if ($request->hasFile('image_file')) {
            $newImage = $request->file('image_file')->store('images', 'public');
            if (!$newImage) {
                return redirect()
                    ->route('collections.show', $collection->id)
                    ->with('error', 'Element creation failed');
            }

            $validatedFormFields['image'] = $newImage;
        }

        $element = new CollectionElement;
        $element->name = $validatedFormFields['name'];
        $element->description = $validatedFormFields['description'];
        $element->image = $validatedFormFields['image'] ?? null;
        $element->collection_entity_id = $collection->id;

        $elementSaved = $element->save();
        if (!$elementSaved) {
            return redirect()
                ->route('collections.show', $collection->id)
                ->with('error', 'Element creation failed');
        }

        return redirect()
            ->route('collections.show', $collection->id)
            ->with('success', 'Element created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CollectionElement $collectionElement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionElement $collectionElement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionElementRequest $request, CollectionElement $collectionElement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionElement $collectionElement)
    {
        //
    }
}
