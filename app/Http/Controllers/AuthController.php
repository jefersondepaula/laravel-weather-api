<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    /**
     * AuthService instance to handle authentication related tasks.
     * @var AuthService
     */
    protected $authService;

    /**
     * Instantiate a new AuthController instance.
     * @param  AuthService  $authService  A service class instance to handle authentication.
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle a login request to the application.
     * Utilizes the AuthService to authenticate the user based on the validated request data.
     * Returns a JsonResponse containing either the authentication data (including token) if successful,
     * or an error message if authentication fails.     *
     * @param  LoginRequest  $request  The incoming request, with required validation.
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $response = $this->authService->authenticate($validated);

        // Retrieve the HTTP status code from the response, defaulting to 500 if not set.
        $statusCode = $response['statusCode'] ?? 500;

        return response()->json($response, $statusCode);
    }
}
