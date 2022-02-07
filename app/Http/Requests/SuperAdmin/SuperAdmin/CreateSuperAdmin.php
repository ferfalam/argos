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
        //TODO ce fichier à été modifier
        return [
            'email' => 'required|unique:users,email',
            'name'  => 'required',
            'password'  => 'required',
            'civility'  => 'required',
            'address'  => 'required',
            'country'  => 'required',
            'city'  => 'required',
            'qualification'  => 'required',
            'birthday'  => 'required|date:Y-m-d',
            'native_country'  => 'required',
            'nationality'  => 'required',
            'language'  => 'required',
            'observation'  => 'required',
            'company_email' => 'required|unique:users,username',
            'tel' => 'required',
            'mobile' => 'required',
            'image' => 'image'
        ];
    }

}
