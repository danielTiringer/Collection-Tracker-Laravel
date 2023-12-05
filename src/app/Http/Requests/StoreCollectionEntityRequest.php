<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreCollectionEntityRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('collection_entities', 'name'),
                'max:255',
            ],
            'description' => 'required',
            'goal' => [
                'nullable',
                'integer',
            ],
            'image' => [
                'nullable',
                File::image()
                    ->min('1kb')
                    ->max('10mb'),
            ]
        ];
    }
}
