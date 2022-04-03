<?php

namespace App\Http\Requests;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
class StoreCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('country_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'num_code'    => [
                'string',
                'nullable',
            ],
            'code_2'      => [
                'string',
                'required',
            ],
            'code_3'      => [
                'string',
                'nullable',
            ],
            'name'        => [
                'string',
                'required',
            ],
            'nationality' => [
                'string',
                'required',
            ],
        ];
    }
}
