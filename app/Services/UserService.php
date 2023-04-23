<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function create($params): void
    {
        User::query()->create($params);
    }

    public function getUserByToken($token): Model|null
    {
        return User::query()
            ->where('token', $token)
            ->where('token_active', true)
            ->first();
    }

    public function deactivateUser($user): void
    {
        $user->update([
            'token_active' => false,
        ]);
    }

    public function updateUserToken($user, $new_token): void
    {
        $user->update([
            'token' => $new_token,
            'token_valid_until' => now()->addDays(7),
        ]);
    }
}
