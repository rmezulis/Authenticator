<?php


namespace App\Controllers;


class RegistrationController
{
    public function store()
    {
        $user = "SELECT * FROM users WHERE email = :email";
        $user = getSingleRow($user, ['email' => $_POST['email']]);
        if (!$user) {
            $user = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            database()->prepare($user)->execute([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);
        }
        header('Location: /');
    }
}