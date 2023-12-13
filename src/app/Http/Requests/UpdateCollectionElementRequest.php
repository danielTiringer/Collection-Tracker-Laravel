<?php

namespace App\Http\Requests;

use App\Enums\CollectionElementStatus;
use App\Models\Source;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;

class UpdateCollectionElementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => [
                'required',
                'max:255',
            ],
            'description' => 'required',
            'status' => [
                'required',
                new Enum(CollectionElementStatus::class)
            ],
            'source' => [
                'required',
                // Accept a number of 0 (not defined), or any ID in the Source table
                Rule::in(
                    array_merge(
                        [0],
                        Source::all()->map(function (Source $source) {
                            return $source->id;
                        })->toArray()
                    )
                ),
            ],
            'image_file' => [
                'nullable',
                File::image()
                    ->min('1kb')
                    ->max('10mb'),
            ],
        ];
    }
}
