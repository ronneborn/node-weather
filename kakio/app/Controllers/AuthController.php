<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Session;
use App\Core\Validator;
use App\Repositories\UserRepository;
use App\Core\Database;

class AuthController extends Controller
{
    public function showLogin(Request $request): void
    {
        $this->view('auth/login', ['title' => 'Logga in']);
    }

    public function login(Request $request): void
    {
        if (!Csrf::verify($request->input('_csrf'))) {
            http_response_code(419); exit('CSRF');
        }

        $repo = new UserRepository();
        $user = $repo->findByEmail((string) $request->input('email'));

        if (!$user || !password_verify((string) $request->input('password'), $user['password_hash'])) {
            Session::put('error', 'Fel e-post eller lösenord.');
            $this->redirect('/logga-in');
        }

        Auth::login((int) $user['id']);
        $this->redirect('/app');
    }

    public function showRegister(Request $request): void
    {
        $this->view('auth/register', ['title' => 'Registrera']);
    }

    public function register(Request $request): void
    {
        if (!Csrf::verify($request->input('_csrf'))) {
            http_response_code(419); exit('CSRF');
        }

        $v = (new Validator())
            ->required('name', $request->input('name'), 'Namn krävs')
            ->required('email', $request->input('email'), 'E-post krävs')
            ->email('email', $request->input('email'), 'Ogiltig e-post')
            ->required('password', $request->input('password'), 'Lösenord krävs')
            ->min('password', (string) $request->input('password', ''), 8, 'Minst 8 tecken');

        if ($v->fails()) {
            Session::put('error', implode(', ', array_merge(...array_values($v->errors()))));
            $this->redirect('/registrera');
        }

        $repo = new UserRepository();
        $id = $repo->create([
            'name' => trim((string) $request->input('name')),
            'email' => mb_strtolower(trim((string) $request->input('email'))),
            'password_hash' => password_hash((string) $request->input('password'), PASSWORD_DEFAULT),
            'role' => 'customer',
        ]);

        Database::connection()->prepare("INSERT INTO subscriptions (user_id,plan_id,status,starts_at,created_at,updated_at) VALUES (:user_id,1,'active',NOW(),NOW(),NOW())")
            ->execute(['user_id' => $id]);

        Auth::login($id);
        $this->redirect('/app');
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        $this->redirect('/');
    }
}
