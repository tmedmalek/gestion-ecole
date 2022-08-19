<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function generateToken($data)
    {
        $user = User::firstWhere('email', $data['email']);
        if (isset($user)) {
            $response = Http::asForm()->post(url('/oauth/token'), [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => '3rNTMRNa0rqwz0UKNATjbNIjC6M8uC1nT5V4TNGV',
                'username' => $data['email'],
                'password' => $data['password'],
                'scope' => '*'

            ]);

            if ($response->status() == 200)
                return json_decode($response->body());
        }
        return null;
    }
}
