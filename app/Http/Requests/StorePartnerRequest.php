<?php

namespace App\Http\Requests;

use App\Models\Partner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('partner_create');
    }

    public function rules()
    {
        return [
            'partner_name' => [
                'string',
                'required',
            ],
            'website_url' => [
                'string',
                'nullable',
            ],
            'partner_logo' => [
                'required',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
