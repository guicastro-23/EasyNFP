<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cProd'    => 'required|string|max:60|unique:produtos,cProd',
            'xProd'    => 'required|string|max:120',
            'cEAN'     => 'required|string',
            'cEANTrib' => 'required|string',
            'ncm'      => 'required|string|size:8', 
            'cest'     => 'nullable|string', 
            'uCom'     => 'required|string|max:6',
            'uTrib'    => 'required|string|max:6',
        ];
    }
}
