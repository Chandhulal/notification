<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data = $this->authService->authenticate($credentials);

        if (!$data['success']) {
            return api_error(false, 'Invalid credentials', 401);
        }

        return api_success(true, $data['message'], $data['data']);

        
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'
            ],

        ]);

        $data = $this->authService->register($validatedData);

        if (!$data['success']) {
            return api_error(false, $data['message'], 400);
        }

        return api_success(true, $data['message'], $data['data'], 201);
    }

    public function logout(Request $request)
    {
        $response = $this->authService->logout($request->user());
        return api_success(true, $response['message']);
    }
}
