<?php

namespace Modules\Zoom\Http\Requests\Meeting;

use Froiden\LaravelInstaller\Request\CoreRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoom extends CoreRequest
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
        $setting = company_setting();
        return [
            'room_title' => 'required',
            'room_location' => 'required',
            'room_capacity' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.0.required_without_all' => __('zoom::modules.zoommeeting.attendeeValidation'),
            'client_id.0.required_without_all' => __('zoom::modules.zoommeeting.attendeeValidation'),
        ];
    }
}
