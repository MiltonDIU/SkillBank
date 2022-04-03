<?php

namespace App\Http\Requests;

use App\Models\Social;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSocialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'url' => [
                'string',
                'required',
            ],
            'icon_class_name' => [
                'string',
                'required',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
