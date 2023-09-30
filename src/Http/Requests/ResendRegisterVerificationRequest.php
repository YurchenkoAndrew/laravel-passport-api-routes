<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResendRegisterVerificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:50'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
