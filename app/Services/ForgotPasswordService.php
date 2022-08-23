<?php

namespace App\Services;

use App\Http\Requests\StoreForgotPasswordRequest;
use App\Mail\ResetPasword;
use App\Mail\updatepassword;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isNull;

class ForgotPasswordService
{
    public function forgotpassword($data)
    {

        $user = User::firstwhere('email', $data['email']);
        if (isset($user)) {

            $password_reset =  PasswordResets::updateOrCreate(
                ['email' => $data['email']],
                [
                    'token' => Str::random(64)
                ]
            );

            $url = config('app.front_url') . '?token=' . $password_reset->token . '&&email=' . $data['email'];
            Mail::to($data['email'])->send(new ResetPasword($url));
            return $password_reset;
        }
        return null;
    }

    public function verifytoken($data)
    {
        $resetpass = PasswordResets::firstWhere(['email' => $data['email'], 'token' => $data['token']]);
        return $resetpass;
    }

    public function resetpassword($data)
    {
        $token = $this->verifytoken($data);
        if (is_null($token)) {
            return null;
        }
        $user =   User::firstwhere('email', $data['email']);
        if (isset($user)) {

            $user->update(
                [
                    'password' => bcrypt($data['password'])
                ]
            );
            Mail::to($data['email'])->send(new updatepassword());
            $token->delete();
            return $user;
        }
    }
}
