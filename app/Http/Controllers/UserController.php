<?php

namespace App\Http\Controllers;

use App\DTOs\LoginDto;
use App\DTOs\RegisterDto;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $registerDto = new RegisterDto(
                $request->name,
                $request->email,
                $request->password
            );

            return $this->success($this->userService->register($registerDto)['message']);
        }catch (Exception $exception){
            return $this->error($exception->getMessage());
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginDto = new LoginDto($request->email, $request->password);
            $loginData = $this->userService->login($loginDto);

            return $this->response([
                'token' => $loginData['token'],
                'token_type' => $loginData['token_type'],
            ]);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        try {
            return $this->response(new UserResource($request->user()));
        } catch (Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $result = $this->userService->logout($request->user());

            return $this->success($result['message']);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }
}
