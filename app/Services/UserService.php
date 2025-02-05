<?php

namespace App\Services;

use App\DTOs\LoginDto;
use App\DTOs\RegisterDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * @param RegisterDto $registerDto
     * @return string[]
     */
    public function register(RegisterDto $registerDto): array
    {
        $user = User::query()->create([
            'name' => $registerDto->name,
            'email' => $registerDto->email,
            'password' => Hash::make($registerDto->password),
        ]);

        $user->assignRole('user');

        return ['message' => 'Registration successful'];
    }

    /**
     * @param LoginDto $loginDto
     * @return array
     */
    public function login(LoginDto $loginDto): array
    {
        $user = User::query()
            ->where('email', $loginDto->email)
            ->first();

        if (!$user || !Hash::check($loginDto->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['email yoki parol noto‘g‘ri.'],
            ]);
        }

        return [
            'token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }

    /**
     * @param $user
     * @return string[]
     */
    public function logout($user): array
    {
        $user->tokens()->delete();

        return ['message' => 'Logout successful'];
    }
}
