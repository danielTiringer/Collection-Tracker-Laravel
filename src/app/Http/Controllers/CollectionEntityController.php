<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionEntityRequest;
use App\Http\Requests\UpdateCollectionEntityRequest;
use App\Models\CollectionEntity;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CollectionEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|ContractsApplication
    {
        $collections = auth()->user()->collectionEntities()->paginate(10);

        return view('collection_entity.index', [
            'collections' => $collections,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|ContractsApplication
    {
        return view('collection_entity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionEntityRequest $request): RedirectResponse
    {
        $validatedFormFields = $request->validated();

        if ($request->hasFile('image_file')) {
            $newImage = $request->file('image_file')->store('images', 'public');
            if (!$newImage) {
                return redirect()
                    ->route('collections.index')
                    ->with('error', 'Collection creation failed');
            }

            $validatedFormFields['image'] = $newImage;
        }

        (new CollectionEntity)->create($validatedFormFields);

        return redirect()
            ->route('collections.index')
            ->with('success', 'Collection created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CollectionEntity $collection): ContractsApplication|Factory|View|Application|RedirectResponse
    {
        try {
            $this->authorize('view', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to view collection');
        }

        return view('collection_entity.show', [
            'collection' => $collection,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionEntity $collection): View|Application|Factory|ContractsApplication|RedirectResponse
    {
        try {
            $this->authorize('update', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit collection');
        }

        return view('collection_entity.edit', [
            'collection' => $collection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionEntityRequest $request, CollectionEntity $collection): RedirectResponse
    {
        try {
            $this->authorize('update', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to edit collection');
        }

        $validatedFormFields = $request->validated();

        if ($request->hasFile('image_file')) {
            if ($collection->image) {
                $oldImageRemoved = Storage::disk('public')->delete($collection->image);
                if (!$oldImageRemoved) {
                    return redirect()
                        ->route('collections.show', $collection)
                        ->with('error', 'Collection update failed');
                }
            }

            $newImage = $request->file('image_file')->store('images', 'public');
            if (!$newImage) {
                return redirect()
                    ->route('collections.show', $collection)
                    ->with('error', 'Collection update failed');
            }

            $validatedFormFields['image'] = $newImage;
        }

        $collectionUpdated = $collection->update($validatedFormFields);
        if (!$collectionUpdated) {
            return redirect()
                ->route('collections.show', $collection)
                ->with('error', 'Collection update failed');
        }

        return redirect()
            ->route('collections.show', $collection)
            ->with('success', 'Collection updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionEntity $collection): RedirectResponse
    {
        try {
            $this->authorize('delete', $collection);
        } catch (AuthorizationException) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Not authorized to delete collection');
        }

        $collectionDeleted = $collection->delete();
        if (!$collectionDeleted) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Collection deletion failed');
        }

        return redirect()
            ->route('collections.index')
            ->with('success', 'Collection deleted successfully');
    }
}
