<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateVerifyLoginOTPAPIRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => ['required'],
            'otp' => ['required'],
        ];
    }
}
