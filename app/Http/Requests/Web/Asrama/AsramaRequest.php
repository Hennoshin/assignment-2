<?php

namespace App\Http\Requests\Web\Asrama;

use Illuminate\Foundation\Http\FormRequest;

class AsramaRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable',
            'lokasi' => 'nullable'
        ];
    }
}
