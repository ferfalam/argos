<?php

namespace App\Http\Requests\Admin\Employee;

use App\Http\Requests\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends CoreRequest
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
        $rules = [
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'name'  => 'required',
            'password'  => 'required',
            'civility'  => 'required',
            'address'  => 'required',
            //'departement_id' => "required",
            'country'  => 'required',
            'birthday'  => 'required',
            'city'  => 'required',
            //'qualification'  => 'required',
            'native_country'  => 'required',
            'nationality'  => 'required',
            'language'  => 'required',
            //'company_email' => 'required|unique:users,username',
            //'tel' => 'required',
            'mobile' => 'required',
            'image' => 'image'
        ];

        if (request()->get('custom_fields_data')) {
            $fields = request()->get('custom_fields_data');
            foreach ($fields as $key => $value) {
                $idarray = explode('_', $key);
                $id = end($idarray);
                $customField = \App\CustomField::findOrFail($id);
                if ($customField->required == 'yes' && (is_null($value) || $value == '')) {
                    $rules["custom_fields_data[$key]"] = 'required';
                }
            }
        }
        return $rules;
    }

    public function attributes()
    {
        $attributes = [];
        if (request()->get('custom_fields_data')) {
            $fields = request()->get('custom_fields_data');
            foreach ($fields as $key => $value) {
                $idarray = explode('_', $key);
                $id = end($idarray);
                $customField = \App\CustomField::findOrFail($id);
                if ($customField->required == 'yes') {
                    $attributes["custom_fields_data[$key]"] = $customField->label;
                }
            }
        }
        return $attributes;
    }

}
