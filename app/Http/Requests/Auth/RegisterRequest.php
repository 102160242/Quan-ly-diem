<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $validator = null;
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
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ Email',
            'name' => 'Tên',
            'password' => 'Mật khẩu'
        ];
    }
    /**
     * Custom the error messages
     */
    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max:255' => ':attribute không được vượt quá 255 ký tự',
            'unique' => ':attribute đã được đăng ký sử dụng',
            'string' => ':attribute phải là một chuỗi',
            'min:6' => ':attribute phải có ít nhất 6 ký tự',
            'confirmed' => 'Xác nhận :attribute không trùng khớp'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}
