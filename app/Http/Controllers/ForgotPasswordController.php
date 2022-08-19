<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForgotPasswordRequest;
use App\Mail\ResetPasword;
use App\Models\password_resets;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

use function PHPUnit\Framework\isNull;

class ForgotPasswordController extends Controller
{
    public function forgotpassword(StoreForgotPasswordRequest $request)
    {

        // bech nthabtou l email mawjoud fel DB walal le 
        $user = User::firstwhere('email', $request->email);
        if (is_null($user)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        // ken mawjoud ngenriw token
        // nsobou  return response(['success' => -1, 'message' => 'is not found'], 200);token w el email fi Reset Password table

        password_resets::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => Str::random(64)
            ]
        );

        Mail::to($request->email)->send(new ResetPasword());

        return response(['success' => 1, 'message' => 'mail ressu'], 201);


        // nab3tho mail lel user fih (link fornt) + token + email 
    }

    public function verifytoken(StoreForgotPasswordRequest $request)
    {
        //return  password_resets::all();
        // t thabet email w token mawjoudin fel DB walla le 
        $resetpass = password_resets::firstWhere(['email' => $request->email, 'token' => $request->token]);
        if (isset($resetpass)) {
            return response(['succes' => 1, 'message' => 'token is valide'], 201);
        }
        return response(['succes' => 1, 'message' => 'token non valide'], 200);
    }
}
