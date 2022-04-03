<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'sub_title' => [
                'string',
                'nullable',
            ],
            'get_started_text' => [
                'string',
                'nullable',
            ],
            'get_started_url' => [
                'string',
                'nullable',
            ],
            'learn_more_text' => [
                'string',
                'nullable',
            ],
            'learn_more_url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
