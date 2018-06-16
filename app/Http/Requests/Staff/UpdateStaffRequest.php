<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\Request;
use App\Models\Staff\Staff;

class UpdateStaffRequest extends Request
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
        return Staff::$rules;
    }
}
