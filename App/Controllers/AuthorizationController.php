<?php


namespace App\Controllers;


class AuthorizationController
{
    public function handle()
    {
        $user = 'SELECT * FROM users WHERE email = :email';
        $user = getSingleRow($user, ['email' => $_POST['email']]);
        if ($user) {
            if (password_verify($_POST['password'], $user['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $attributes = 'SELECT * FROM attributes WHERE user_id = :id';
                $_SESSION['attributes'] = getAllRows($attributes, ['id' => $_SESSION['id']]);
                header('Location: /profile');
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }

}