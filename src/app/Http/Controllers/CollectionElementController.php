<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionElementRequest;
use App\Http\Requests\UpdateCollectionElementRequest;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\Source;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
            'sources' => Source::all(),
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
//        dd($validatedFormFields);

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
        $element->status = $validatedFormFields['status'];
        $element->image = $validatedFormFields['image'] ?? null;
        $element->collection_entity_id = $collection->id;

        $elementSaved = $element->save();
        if (!$elementSaved) {
            return redirect()
                ->route('collections.show', $collection->id)
                ->with('error', 'Element creation failed');
        }

        if ($validatedFormFields['source'] != 0) {
            $element->sources()->attach([$validatedFormFields['source']]);
        }

        return redirect()
            ->route('collections.show', $collection->id)
            ->with('success', 'Element created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CollectionEntity $collection, CollectionElement $element): Factory|View|Application|RedirectResponse|ContractsApplication
    {
        try {
            $this->authorize('view', $element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to see element');
        }

        return view('collection_element.show', [
            'element' => $element,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionEntity $collection, CollectionElement $element): Factory|View|Application|RedirectResponse|ContractsApplication
    {
        try {
            $this->authorize('update', $element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit element');
        }

        return view('collection_element.edit', [
            'element' => $element,
            'sources' => Source::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateCollectionElementRequest $request,
        CollectionEntity $collection,
        CollectionElement $element,
    ): RedirectResponse
    {
        try {
            $this->authorize('update', $element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit element');
        }

        $validatedFormFields = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($element->image) {
                $oldImageRemoved = Storage::disk('public')->delete($element->image);
                if (!$oldImageRemoved) {
                    return redirect()
                        ->route('elements.show', $element)
                        ->with('error', 'Element update failed');
                }
            }

            $newImage = $request->file('image_file')->store('images', 'public');
            if (!$newImage) {
                return redirect()
                    ->route('elements.show', $element)
                    ->with('error', 'Element update failed');
            }

            $validatedFormFields['image'] = $newImage;
        }

        $elementUpdated = $element->update($validatedFormFields);
        if (!$elementUpdated) {
            return redirect()
                ->route('elements.show', ['collection' => $element->entity, 'element' => $element])
                ->with('error', 'Element update failed');
        }

        $elementHasSource = $element->sources()->exists();

        if ($validatedFormFields['source'] != 0) {
            if (!$elementHasSource) {
                $element->sources()->attach([$validatedFormFields['source']]);
            } else {
                $element->sources()->sync([$validatedFormFields['source']]);
            }
        }

        if ($validatedFormFields['source'] == 0 && $elementHasSource) {
            $element->sources()->sync([]);
        }

        return redirect()
            ->route('elements.show', ['collection' => $element->entity, 'element' => $element])
            ->with('success', 'Element updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionEntity $collection, CollectionElement $element): RedirectResponse
    {
        try {
            $this->authorize('delete', $element);
        } catch (AuthorizationException) {
            return redirect()
                ->route('elements.show', ['collection' => $element->entity, 'element' => $element])
                ->with('error', 'Not authorized to delete element');
        }

        $elementDeleted = $element->delete();
        if (!$elementDeleted) {
            return redirect()
                ->route('elements.show', ['collection' => $element->entity, 'element' => $element])
                ->with('error', 'Element deletion failed');
        }

        return redirect()
            ->route('collections.show', ['collection' => $element->entity])
            ->with('success', 'Element deleted successfully');
    }
}
