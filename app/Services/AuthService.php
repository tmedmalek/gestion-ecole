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
                'client_id' => '971d6d50-46f4-4365-b117-1f03425452c2',
                'client_secret' => 'blTgynXEJpUFQDnZCfyksWP1mfStdYX1nmvG7cPP',
                'username' => $data['email'],
                'password' => $data['password'],
                'scope' => $user->type
            ]);
            if ($response->status() == 200)
                return json_decode($response->body());
        }
        return null;
    }
}
