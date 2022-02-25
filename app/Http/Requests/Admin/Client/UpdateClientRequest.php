<?php

namespace App\Http\Requests\Admin\Client;

use Froiden\LaravelInstaller\Request\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends CoreRequest
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
            'email' => [
                'required',
                Rule::unique('client_details')->where(function($query) {
                    $query->where('company_id', company()->id);
                })->ignore($this->route('client'), 'id')
            ],
            'company_name' => 'required|max:200',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'company_phone' => 'required|digits:10',
            'mobile' => 'required|digits:10',
            'fax' => 'required|digits:10',
            'company_email' => 'required|email',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'language' => 'required',
            'emailNotification' => 'required',
            'smsNotification' => 'required',
            'name' => 'required',
            'function' => 'required',
            'password' => 'nullable|min:6',
            'p_phone' => 'required|digits:10',
            'p_mobile' => 'required|digits:10',
            'p_fax' => 'required|digits:10',

        ];
        if (!is_null(request()->get('website'))) {
            $type = request()->get('website');
            if(str_contains($type, 'http://') || str_contains($type, 'http://')){
           
            }else{
                if(is_null(request()->get('hyper_text'))){
                    $rules['website'] = 'url';
                    $rules['hyper_text'] = 'required';
                }else{
                    $rules['website'] = 'required';
                }
               
            }
        }elseif(!is_null(request()->get('hyper_text'))){
            $rules['website'] = 'required';
        }
       
        return $rules;

        // return [
        //     'email' => [
        //         'required',
        //         Rule::unique('client_details')->where(function($query) {
        //             $query->where(['email' => $this->request->get('email'), 'company_id' => company()->id]);
        //         })->ignore($this->route('client'), 'id')
        //     ],
        //     // 'slack_username' => 'nullable|unique:employee_details,slack_username,'.$this->route('client'),
        //     'name'  => 'required',
        //     'website' => 'nullable|url',
        // ];
        
    }

}
