<?php

namespace App\Http\Requests\SuperAdmin\SuperAdmin;

use App\Http\Requests\SuperAdmin\SuperAdminBaseRequest;

class UpdateSuperAdmin extends SuperAdminBaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
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
            'tel' => 'required',
            'mobile' => 'required',
            'image' => 'sometimes|file'
        ];
    }

}
