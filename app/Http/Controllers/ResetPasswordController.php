<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordTokenRequest;
use App\Services\ForgotPasswordService;

class ResetPasswordController extends Controller
{

    private $ForgotPasswordService;

    public function __construct(ForgotPasswordService $ForgotPasswordService)
    {
        $this->ForgotPasswordService = $ForgotPasswordService;
    }

    public function ResetPassword(ResetPasswordTokenRequest $request)
    {
      $resetpass = $this->ForgotPasswordService->resetpassword($request->validated());
        if (isset($resetpass)) {
            return response(['succes' => 1, 'message' => 'password is upadated'], 201);
        }
        return response(['succes' => 1, 'message' => 'password non updated'], 200);
    }
}
