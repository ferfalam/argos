<?php

namespace App\Http\Requests\Admin\Employee;

use App\EmployeeDetails;
use Froiden\LaravelInstaller\Request\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CoreRequest
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
        $detailID = EmployeeDetails::where('user_id', $this->route('employee'))->first();
        return [
            //            'employee_id' => 'required|unique:employee_details,employee_id,'.$detailID->id,
            // 'employee_id' => [
            //     'required',
            //     Rule::unique('employee_details')->where(function($query) use($detailID) {
            //         $query->where('company_id', company()->id);
            //         $query->where('id', '<>', $detailID->id);
            //     })
            // ],
            'username' => 'required',
            'email' => 'required',
            'name'  => 'required',
            //'password'  => 'required',
            'civility'  => 'required',
            'address'  => 'required',
            //'departement_id' => "required",
            'country'  => 'required',
            'city'  => 'required',
            //'qualification'  => 'required',
            'native_country'  => 'required',
            'nationality'  => 'required',
            'language'  => 'required',
            'birthday'  => 'required',
            //'company_email' => 'required|unique:users,username',
            //'tel' => 'required',
            'mobile' => 'required',
            'image' => 'image'
        ];
    }

}
