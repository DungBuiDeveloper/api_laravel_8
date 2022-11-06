<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator; 

class UpdatePasswordRequest extends FormRequest {
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
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'EMAIL_REQUIRED',
            'email.email' => 'EMAIL_FORMAT',
            'password.required' => 'PASSWORD_REQUIRED',
            'password.confirmed' => 'PASSWORD_CONFIRMED',
        ];
    }

}