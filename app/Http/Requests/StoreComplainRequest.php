<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'complain_type' => 'required',
            'department_id' => 'required|exists:departments,id',
            'subdepartment_id' => 'required|exists:subdepartments,id',
            'complaint_short_desc' => 'required|min:3|max:255',
            'complaint_desc' => 'required|min:3|max:500',
            'complaint_reg_date' => 'required|date',
        ];
    }
}