<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'min:3'],
            'cover' => 'mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome não pode ficar vazio.',
            'nome.min' => 'Nome do campo tem que ser maior que :min.',
            'cover.mimes' => 'Capa tem que ser do tipo :values.',
        ];
    }
}
