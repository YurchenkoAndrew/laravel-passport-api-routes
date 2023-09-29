<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Controller;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests\RegisterRequest;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $registerRequest): JsonResponse
    {
        $user = new User([
            'name' => $registerRequest->input('name'),
            'email' => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password')),
        ]);
        $user->save();
        event(new Registered($user));
        return response()->json(['message' => __('laravel-passport-api-routes::register.check_your_email')]);
    }
}
