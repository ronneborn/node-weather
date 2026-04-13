<?php
namespace App\Core;

use App\Repositories\UserRepository;

class Auth
{
    public static function user(): ?array
    {
        $id = Session::get('user_id');
        if (!$id) {
            return null;
        }
        return (new UserRepository())->findById((int) $id);
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function login(int $userId): void
    {
        Session::regenerate();
        Session::put('user_id', $userId);
    }

    public static function logout(): void
    {
        Session::forget('user_id');
        Session::regenerate();
    }
}
