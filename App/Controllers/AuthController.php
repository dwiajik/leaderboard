<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class AuthController extends BaseController
{
    public function getLogin()
    {
        session_start();
        if (isset($_SESSION['username']))
        {
            header('Location: /');
        }
        else
        {
            $this->view("auth/login.php");
        }
    }

    public function postLogin()
    {
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = stripslashes($username);
        $password = stripslashes($password);

        $userRepo = new UserRepository();
        $user = $userRepo->getByUsername($username);

        if ($user->username == $username && password_verify($password, $user->password))
        {
            $_SESSION['username'] = $user->username;

            header('Location: /');
        }

        header('Location: /login');
    }

    public function getLogout()
    {
        session_start();
        if (isset($_SESSION['username']))
        {
            unset($_SESSION['username']);
        }

        header('Location: /');
    }

    public function getRegister()
    {
        session_start();
        if (isset($_SESSION['username']))
        {
            header('Location: /');
        }
        else
        {
            $this->view("auth/register.php");
        }
    }

    public function postRegister()
    {
        session_start();

        $userRepo = new UserRepository();

        if ($_POST['password'] == $_POST['passwordConfirmation']) {
            $user = new User();
            $user->email = $_POST['email'];
            $user->username = $_POST['username'];
            if ($_POST['password'] != "")
                $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $user->fullname = $_POST['fullname'];

            $userRepo->insert($user);
        }

        $this->postLogin();

        header('Location: /');
    }

    public static function auth()
    {
        session_start();
        if (isset($_SESSION['username']))
        {
            $userRepo = new UserRepository();
            $user = $userRepo->getByUsername($_SESSION['username']);

            if ($user != null)
            {
                return $user;
            }
            else
            {
                unset($_SESSION['username']);
                header('Location: /login');
            }
        }
        else
        {
            header('Location: /login');
        }
    }
}