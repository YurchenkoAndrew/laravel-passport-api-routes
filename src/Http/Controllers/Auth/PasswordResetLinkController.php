<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Controller;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests\PasswordResetLinkRequest;

class PasswordResetLinkController extends Controller
{
    public function create(): JsonResponse
    {
        return response()->json(['message' => __('laravel-passport-api-routes::password-reset.link_sent')], Response::HTTP_OK);
    }
    public function store(PasswordResetLinkRequest $request): JsonResponse
    {

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? response()->json(['message' => __('laravel-passport-api-routes::password-reset.link_sent')], Response::HTTP_OK)
            : response()->json(['message' => __('laravel-passport-api-routes::password-reset.email_not_found')], Response::HTTP_BAD_REQUEST);
    }
}
