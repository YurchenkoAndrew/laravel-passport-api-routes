<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Controller;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests\NewPasswordStoreRequest;

class NewPasswordController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        return response()->json(['token' => $request['token']], Response::HTTP_OK);
    }

    public function store(NewPasswordStoreRequest $request): JsonResponse
    {

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise, we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? response()->json(['message' => __('laravel-passport-api-routes::password-reset.password_changed')], Response::HTTP_OK)
            : response()->json(['message' => __('laravel-passport-api-routes::password-reset.token_or_email_is_not_valid')], Response::HTTP_BAD_REQUEST);
    }
}
