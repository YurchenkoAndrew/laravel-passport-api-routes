<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Controller;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Models\User;

class RegisterVerificationController extends Controller
{
    public function verify($user_id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return response()->json(__('laravel-passport-api-routes::register.invalid_token'), Response::HTTP_BAD_GATEWAY);
        }
        $user = User::findOrFail($user_id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return redirect(config('laravel-passport-api-routes.app-front-url') . config('laravel-passport-api-routes.after-register-email-confirmation-route'))->with(['message' => 'laravel-passport-api-routes::register.registration_successful'], Response::HTTP_OK);
    }

    public function resend(): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(['message' => __('laravel-passport-api-routes::register.email_confirmed')], Response::HTTP_BAD_REQUEST);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json(['message' => __('laravel-passport-api-routes::register.confirmation_link_sent')], Response::HTTP_OK);
    }
}
