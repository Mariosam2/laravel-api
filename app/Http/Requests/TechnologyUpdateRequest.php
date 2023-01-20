<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnologyUpdateRequest extends FormRequest
{
    protected $errorBag;

    public function prepareForValidation()
    {
        $this->errorBag = "update-" . $this->technology->id;
    }

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
            'name' => ['required', Rule::unique('technologies')->ignore($this->technology->id), 'max:50', 'alpha'],
        ];
    }
}