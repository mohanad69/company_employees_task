<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name'       => 'nullable|string|max:255',
            'email'      => "nullable|email:rfc,dns|unique:employees,email,{$this->employee->id}",
            'address'    => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'password'   => 'nullable|string|min:8',
            'image'      => 'nullable|image|max:15000',
        ];
    }
}
