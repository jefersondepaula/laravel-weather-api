<?php

namespace App\Services;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class AuthService
 * This service class handles the authentication process using JWT.
 */
class AuthService
{
    /**
     * Authenticate a user based on the provided credentials.
     * This method attempts to authenticate a user and generate a JWT token using the provided credentials.
     * If authentication is successful, it returns an array containing the token, its type, expiry time, and a successful status code.
     * If authentication fails, it returns an array containing an error message and an error status code.
     * @param array $credentials User's credentials.
     * @return array An array containing either the token details and status code, or an error message and status code.
     */
    public function authenticate(array $credentials)
    {
        try {
            // Attempt to authenticate the user with the provided credentials and generate a token.
            if (!$token = JWTAuth::attempt($credentials)) {
                // If authentication fails, return an error message and a 400 status code.
                return ['error' => 'invalid_credentials', 'message'=>'Please try again with a valid credential', 'statusCode' => 400];
            }
        } catch (JWTException $e) {
            // If token generation fails, return an error message and a 500 status code.
            return ['error' => 'could_not_create_token', 'statusCode' => 500];
        }

        // If authentication and token generation are successful, return the token details and a 200 status code.
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 90,
            'statusCode' => 200
        ];
    }
}

