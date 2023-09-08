<?php

namespace App\Http\Requests\Fund;

use Illuminate\Foundation\Http\FormRequest;

class IndexFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'length'    => ['nullable', 'integer', 'between:1,100'],
            'name'      => ['nullable', 'string', 'max:255'],
            'manager'   => ['nullable', 'string', 'max:255'],
            'year'      => ['nullable', 'integer', 'digits:4'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'length.between'    => 'The length must be between :min and :max.',
            'name.max'          => 'The name may not be greater than :max characters.',
            'manager.max'       => 'The manager may not be greater than :max characters.',
            'year.digits'       => 'The year must be exactly :digits digits (e.g., YYYY).',
        ];
    }
}
