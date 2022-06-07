<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'status' => 'required',
            'level' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages(){
        return[
            'title.required' => 'El campo título es obligatorio',
            'title.min' => 'El campo título debe ser al menos de 3 caracteres',
            'title.max' => 'El campo título no puede ser mayor a 255 caracteres',
            'description.required' => 'El campo descripción es obligatorio',
            'description.min' => 'El campo descripción debe ser al menos de 3 caracteres',
            'description.max' => 'El campo descripción es obligatorio',
            'status.required' => 'El campo estado es obligatorio',
            'level.required' => 'El campo nivel es obligatorio',
            'category_id.required' => 'El campo categoría es obligatorio'
        ];
    }
}
