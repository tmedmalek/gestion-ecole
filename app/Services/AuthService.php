<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function generateToken($data)
    {

        $user = User::firstWhere('email', $data['email']);
        if (!isset($user)) {
            return null;
        }
        $client = $this->getClient();
        $response = Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['email'],
            'password' => $data['password'],
            'scope' => $user->type
        ]);
        if ($response->status() == 200)
            return json_decode($response->body());
    }
    public function getClient()
    {
        return DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();
    }
}
