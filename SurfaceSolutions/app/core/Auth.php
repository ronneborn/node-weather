<?php
namespace App\Core;

use App\Models\User;

class Auth
{
    public static function check(): bool
    {
        return (bool) Session::get('admin_id');
    }

    public static function user(): ?array
    {
        $id = Session::get('admin_id');
        if (!$id) {
            return null;
        }
        return (new User())->find((int)$id);
    }

    public static function attempt(string $email, string $password): bool
    {
        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return false;
        }

        Session::put('admin_id', $user['id']);
        return true;
    }

    public static function logout(): void
    {
        Session::forget('admin_id');
    }
}
