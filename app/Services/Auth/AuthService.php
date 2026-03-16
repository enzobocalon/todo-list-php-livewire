<?php

namespace App\Services\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct() {}

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new Exception('Credenciais inválidas.');
        }

        $user = Auth::user();
        $user->tokens()->delete();

        return $user->createToken('api-token')->plainTextToken;
    }

    public function signup(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
