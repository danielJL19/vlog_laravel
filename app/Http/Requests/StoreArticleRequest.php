<?php

namespace App\Http\Requests;

use App\Rules\OnlyLettersAndSpace;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SelectOption;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre'=>['required',new OnlyLettersAndSpace,'unique:articles,nombre'],
            'descripcion'=>'required|alpha_dash:ascii',
            'photo'=>'required|mimes:jpg,png',
            'category_id'=>['required',new SelectOption],
        ];
    }
    public function messages()
    {
        return[
            'nombre.required'=>'El campo de nombre está vacío',
            'nombre.alpha'=>'El campo de nombre solo admite letras',
            'nombre.unique'=>'Este nombre ya esta siendo utilizado',
            'descripcion.required'=>'El campo de descripción está vació',
            'photo.required'=>'El campo de imagen no haz llenado',
            'photo.mimes'=>'El archivo solo admite jpg,png',
        ];
    }
}
