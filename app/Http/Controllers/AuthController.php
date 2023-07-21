<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $AuthService;

    public function __construct(AuthService $authService)
    {
        $this->AuthService = $authService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $teamId = $request->input('teamId');

        $this->AuthService->register($name, $email, $password, $teamId);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        if (!$token = $this->AuthService->login($email, $password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function verifyDoubleOptin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $token = $request->input('token');

        if (!$this->AuthService->verifyDoubleOptin($token)) {
            return response()->json(['message' => 'Invalid or expired verification token'], 400);
        }

        return response()->json(['message' => 'Double opt-in verified successfully']);
    }

    public function requestPasswordReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $email = $request->input('email');

        $this->AuthService->requestPasswordReset($email);

        return response()->json(['message' => 'Password reset email sent']);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $token = $request->input('token');
        $password = $request->input('password');

        if (!$this->AuthService->resetPassword($token, $password)) {
            return response()->json(['message' => 'Invalid or expired password reset token'], 400);
        }

        return response()->json(['message' => 'Password reset successfully']);
    }
}
