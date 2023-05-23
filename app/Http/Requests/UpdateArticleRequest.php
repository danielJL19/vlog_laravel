<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SelectOption;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
       

        $article= $this->route('article');
            return [
                'nombre' => ['required', 'alpha', Rule::unique('articles')->ignore($article)],
                'descripcion'=>'required|alpha_dash:ascii',
                'photo'=>'mimes:jpg,png',
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
