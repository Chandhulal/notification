<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function authenticate(array $credentials)
    {
        //find user
        $user = User::where('email', $credentials['email'])->first();

        //check credentials
        if ($user && Hash::check($credentials['password'], $user->password)) {
            //create token
            $token = $user->createToken('auth_token')->plainTextToken;
            return ['success'=> true,'message' => 'Login successful', 
                'data' => ['access_token' => $token, 'token_type' => 'Bearer']];
        }

        return ['success' => false, 'message' => 'Invalid credentials'];
    }

    public function register(array $data)
    {
        //create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            $user = ['id' => encrypt_id($user->id),'name' => $user->name, 'email' => $user->email];
            return ['success' => true, 'message' => 'User registered successfully', 'data' => $user];
        }

        return ['success' => false, 'message' => 'Registration failed'];
    }

    public function logout(User $user)
    {
        // Revoke all tokens...
        $user->tokens()->delete();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }
}