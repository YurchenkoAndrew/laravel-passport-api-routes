<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "name" => "required|string|max:25",
            "email" => "required|email|unique:users|max:50",
            "password" => "required|string|min:8|confirmed"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
