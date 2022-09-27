<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForgotPasswordRequest;
use App\Http\Requests\StoreVerifyTokenRequest;
use App\Services\ForgotPasswordService;

class ForgotPasswordController extends Controller
{
    public function __construct(private ForgotPasswordService $forgotPasswordService)
    {
    }

    public function ForgotPassword(StoreForgotPasswordRequest $request)
    {
        $token = $this->forgotPasswordService->forgotpassword($request->validated());
        if (isset($token)) {
            return response(['success' => 1, 'message' => 'email sended'], 200);
        }
        return response(['success' => -1, 'message' => 'fqsdfsqfqs'], 200);
    }



    public function Verifytoken(StoreVerifyTokenRequest $request)
    {
        $resetpass = $this->forgotPasswordService->verifytoken($request->validated());
        if (isset($resetpass)) {
            return response(['succes' => 1, 'message' => 'token is valide'], 201);
        }
        return response(['succes' => 1, 'message' => 'token non valide'], 200);
    }
}
