<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'email', 'max:50'],
            'password' => ['required','min:8'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
