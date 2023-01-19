<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeUpdateRequest extends FormRequest
{
    protected $errorBag;
    //override del metodo nella classe form request per generare dinamicamente gli error bag dei form (penso sia così sono andato a tentativi)
    public function prepareForValidation()
    {
        $this->errorBag = "update-" . $this->type->id;
        //dd($this->route('type')->id);
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
            'name' => ['required', Rule::unique('types')->ignore($this->type->id), 'max:100', 'alpha'],
        ];
    }
}
