<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolesRequest extends FormRequest
{
    /**
     * Determine if the Roles is authorized to make this request.
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
            'roles_name' => 'required|string|max:255',
            'roles_code' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'roles_name.required' => 'ชื่อจำเป็นต้องกรอก',
            'roles_name.string' => 'ชื่อต้องเป็นสตริง',
            'roles_name.max' => 'ชื่อต้องมีความยาวไม่เกิน 255 ตัวอักษร',
            'roles_code.required' => 'รหัสจำเป็นต้องกรอก',
            'roles_code.string' => 'รหัสต้องเป็นสตริง',
            'roles_code.max' => 'รหัสต้องมีความยาวไม่เกิน 255 ตัวอักษร',
        ];
    }
}
