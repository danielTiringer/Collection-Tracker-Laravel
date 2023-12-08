<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionEntityRequest;
use App\Http\Requests\UpdateCollectionEntityRequest;
use App\Models\CollectionEntity;
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
        return view('collection_entity.create', [

        ]);
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
    public function show(CollectionEntity $collection): View|Application|Factory|ContractsApplication
    {
        return view('collection_entity.show', [
            'collection' => $collection,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionEntity $collection): View|Application|Factory|ContractsApplication
    {
        return view('collection_entity.edit', [
            'collection' => $collection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionEntityRequest $request, CollectionEntity $collection): RedirectResponse
    {
        $validatedFormFields = $request->validated();

        if ($request->hasFile('image_file')) {
            $oldImageRemoved = Storage::disk('public')->delete($collection->image);
            if (!$oldImageRemoved) {
                return redirect()
                    ->route('collections.show', $collection)
                    ->with('error', 'Collection update failed');
            }

            $newImage = $request->file('image_file')->store('images', 'public');
            if (!$newImage) {
                return redirect()
                    ->route('collections.show', $collection)
                    ->with('error', 'Collection update failed');
            }

            $validatedFormFields['image'] = $newImage;
        }

        $collection->update($validatedFormFields);

        return redirect()
            ->route('collections.show', $collection)
            ->with('success', 'Collection created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionEntity $collection): RedirectResponse
    {
        $collectionDeleted = $collection->delete();
        if (!$collectionDeleted) {
            return redirect()
                ->route('collections.index')
                ->with('error', 'Collection deletion failed');
        }

        return redirect()
            ->route('collections.index')
            ->with('success', 'Collection created successfully');
    }
}
