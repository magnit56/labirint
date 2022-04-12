<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'announcement' => 'required|string',
            'body' => 'required|string',
            'tags' => 'string|nullable',
        ];
    }
}
