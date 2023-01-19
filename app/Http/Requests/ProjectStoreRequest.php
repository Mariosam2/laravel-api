<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:projects', 'max:50'],
            'img' => ['nullable', 'image', 'max:300'],
            'description' => ['nullable', 'max:255'],
            'creation_date' => ['nullable', 'date'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }
}
