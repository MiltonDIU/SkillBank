<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:menus',
            ],
            'slug' => [
                'string',
                'required',
                'unique:menus',
            ],
            'link_type' => [
                'required',
            ],
            'external_link' => [
                'string',
                'nullable',
            ],
            'serial' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'parent' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'positions.*' => [
                'integer',
            ],
            'positions' => [
                'required',
                'array',
            ],
        ];
    }
}
