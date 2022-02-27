<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'name'       => 'required|string|max:255',
            // 'email'      => 'required|email:rfc,dns|unique:employees,email',
            'email'      => 'required|email|unique:employees,email',
            'address'    => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'password'   => 'required|string|min:8',
            'image'      => 'required|image|max:15000',
        ];
    }
}
