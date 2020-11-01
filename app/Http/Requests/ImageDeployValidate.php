<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageDeployValidate extends FormRequest
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
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png',
        ];
    }

    public function messages(){

        return [
            'images.required' => 'Nenhum arquivo inserido.',
            'images.*.mimes' => 'Um ou mais arquivos estão no formato incorreto.'
        ];
    }
    
    
}
