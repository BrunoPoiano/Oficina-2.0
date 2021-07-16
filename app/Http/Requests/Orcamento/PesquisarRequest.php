<?php

namespace App\Http\Requests\Orcamento;

use Illuminate\Foundation\Http\FormRequest;

class PesquisarRequest extends FormRequest
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
            'vendedor' => 'numeric',
            'cliente' => 'max:50',
            'datainicial' => 'date',
            'datafinal' => 'date',
        ];
    }
}
