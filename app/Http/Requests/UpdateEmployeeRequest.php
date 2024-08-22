<?php

namespace App\Http\Requests;

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
        return true; // Set true jika Anda ingin mengizinkan semua user untuk membuat request ini
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email|max:255|unique:employees,email,' . $this->employee->id,
            'phone' => 'nullable|string|max:20',
        ];
    }

}
