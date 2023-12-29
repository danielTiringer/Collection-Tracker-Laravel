<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionElementRequest;
use App\Http\Requests\UpdateCollectionElementRequest;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\Source;
use App\Services\ImageService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application as ContractsApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CollectionElementController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
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

        if ($element->image) {
            $oldImageRemoved = $this->imageService->destroy($element->image);
            if (!$oldImageRemoved) {
                return redirect()
                    ->route('elements.show', ['collection' => $element->entity, 'element' => $element])
                    ->with('error', 'Element deletion failed');
            }
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
