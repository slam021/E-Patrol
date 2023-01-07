<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPersonnelRequest extends FormRequest
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

            'full_name'             => 'required|string|max:191',
            'nick_name'             => 'required|max:10',
            'nik'                   => 'required',
            'gender'                => 'required',
            'address'               => 'required',
            'birth_place'           => 'required',
            'birth_date'            => 'required',
            'phone_number'          => 'required',
            'phone_number_family'   => 'required',
        ];
    }
}
