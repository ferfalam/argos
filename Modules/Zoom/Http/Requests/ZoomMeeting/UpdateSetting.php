<?php

namespace Modules\Zoom\Http\Requests\ZoomMeeting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetting extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
           
            "api_key" => "required | unique:zoom_setting",
            "secret_key" => "required | unique:zoom_setting",
        ];
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
