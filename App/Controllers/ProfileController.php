<?php


namespace App\Controllers;


class ProfileController
{
    public function index()
    {
        session_start();
        if (!$_SESSION['loggedin']) {
            header('Location: /');
        } else {
            include_once 'App/Views/profile.php';
        }
    }

    public function edit()
    {
        session_start();
        $edit = 'UPDATE users SET name = :name ,email = :email WHERE id = :id';
        database()->prepare($edit)->execute([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'id' => $_SESSION['id']
        ]);
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        header('Location: /profile');
    }

    public function storeAttribute()
    {
        session_start();
        $attribute = 'INSERT INTO attributes (user_id, name, value) VALUES (:user_id, :name, :value)';
        database()->prepare($attribute)->execute([
            'user_id' => $_SESSION['id'],
            'name' => $_POST['name'],
            'value' => $_POST['value']
        ]);
        $attributes = 'SELECT * FROM attributes WHERE user_id = :id';
        $_SESSION['attributes'] = getAllRows($attributes, ['id' => $_SESSION['id']]);
        header('Location: /profile');
    }
}