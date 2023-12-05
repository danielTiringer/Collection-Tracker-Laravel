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

class CollectionEntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|ContractsApplication
    {
        $collections = (new CollectionEntity)->paginate(10);

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
    public function edit(CollectionEntity $collectionEntity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionEntityRequest $request, CollectionEntity $collectionEntity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionEntity $collectionEntity)
    {
        //
    }
}
