<?php

namespace App\Http\Requests\SuperAdmin\SuperAdmin;

use App\Http\Requests\SuperAdmin\SuperAdminBaseRequest;

class CreateSuperAdmin extends SuperAdminBaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($_REQUEST);
        return [
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
    }
}
