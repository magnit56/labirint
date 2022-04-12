<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer',
        ];
    }
}
