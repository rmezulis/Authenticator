<?php


namespace App\Controllers;


class HomeController
{
    public function index()
    {
        session_start();
        if (!$_SESSION['loggedin']) {
            include_once 'App/Views/index.html';
        } else {
            header('Location: /profile');
        }
    }
}