<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StorePlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name' => "string[]", 'latitude' => "string[]", 'longitude' => "string[]", 'province' => "string[]"])] public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'latitude' => ['required', 'max:20'],
            'longitude' => ['required', 'max:20'],
            'province' => ['required', 'max:50']
        ];
    }
}
