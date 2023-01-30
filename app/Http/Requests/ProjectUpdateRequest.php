<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
        //dd($this);
        return [
            'title' => ['required', Rule::unique('projects')->ignore($this->project->id), 'max:50'],
            'media.*' => ['nullable', 'mimes:jpg,png,jpeg,gif,mp4,m4v,avi,mov,ogv,qt', 'max:20000'],
            'description' => ['nullable', 'max:255'],
            'creation_date' => ['nullable', 'date'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }
}
