<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = Auth::attempt($request->only('email', 'password'))) {
            return $this->sendErrorJson(
                'Unauthorized.',
                ['error' => 'Invalid credentials'],
                401
            );
        }
        return $this->respondWithToken($token, 'Login successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $message): JsonResponse
    {
        return $this->sendSuccessJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], $message);
    }
}
