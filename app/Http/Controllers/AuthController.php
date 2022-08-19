<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(StoreAuthRequest $request)
    {
        $token = $this->authService->generateToken($request->validated());
        if (isset($token)) {
            return response(['success' => 1, 'token' => $token], 200);
        }
        return response(['success' => -1, 'token' => null], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['success' => 1], 200);
    }
}
