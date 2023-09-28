<?php

namespace YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Controller;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $loginRequest): JsonResponse
    {
        $user = User::query()->where('email', $loginRequest->input('username'))->firstOr(function () {
            throw new Exception(__('laravel-passport-api-routes::login.not_found_email'));
        });
        /** @var User $user */
        if (!$user->validateForPassportPasswordGrant($loginRequest->input('password'))) {
            return response()->json(['message' => __('laravel-passport-api-routes::login.password')], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if (!$user['email_verified_at']) {
            return response()->json(['message' => __('laravel-passport-api-routes::login.email_not_verified_at')], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $response = Http::asForm()->post(config('laravel-passport-api-routes.app-url') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('laravel-passport-api-routes.passport-client'),
            'client_secret' => config('laravel-passport-api-routes.passport-client-secret'),
            'username' => $loginRequest->input('username'),
            'password' => $loginRequest->input('password'),
            'scope' => '',
        ]);
        return response()->json(['tokenResponse' => $response->json()], Response::HTTP_OK);
    }
}
