<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordTokenRequest;
use App\Services\ForgotPasswordService;

class ResetPasswordController extends Controller
{
    public function __construct(private ForgotPasswordService $forgotPasswordService)
    {
    }

    public function ResetPassword(ResetPasswordTokenRequest $request)
    {
        $resetpass = $this->forgotPasswordService->resetpassword($request->validated());
        if (isset($resetpass)) {
            return response(['succes' => 1, 'message' => 'password is upadated'], 201);
        }
        return response(['succes' => 1, 'message' => 'password non updated'], 200);
    }
}
