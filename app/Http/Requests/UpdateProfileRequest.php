<?php

namespace App\Http\Requests;
use App\Models\Profile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('profile_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile'           => [
                'string',
                'min:11',
                'max:20',
                'nullable',
            ],
            'reference_name'   => [
                'string',
                'nullable',
            ],
            'reference_mobile' => [
                'string',
                'nullable',
            ],
        ];
    }
}
