<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\Auth\AuthService;


class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $service) {
        $this->authService = $service;
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();

        $token = $this->authService->login($credentials);

        return response()->json([
            'message' => 'Autenticado com sucesso',
            'token' => $token
        ], 200);
    }

    public function signup(SignupRequest $request) {
        try {
            $data = $request->validated();

            $this->authService->signup($data);

            return response()->json([
                'message' => 'Conta criada com sucesso.'
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Erro ao criar a conta.'
            ], 500);
        }
    }
}
