<?php

namespace App\Controllers;

use App\Helper\StorageHelper;
use App\Models\Container;
use Throwable;

class UserController
{
    public function auth(): void
    {
        $user = Container::getModel('User');
        $password = $_POST["password_confirmation"];
        $user->__set('email', $_POST["email"]);
        $userdata = $user->validate();

        if (is_array($userdata)) {
            if (password_verify($password, $userdata['password'])) {
                session_start();
                $_SESSION = $userdata;
                $feedback = 'successSession';
            } else {
                $feedback = 'credentialsError';
            }
        } else {
            $feedback = 'errorSession';
        }
        header("Location: /?feedback=$feedback");
        exit;
    }

    public function newaccount(): void
    {
        try {
            $user = Container::getModel('User');
            $storage = new StorageHelper();
            $data = $_POST;
            $avatar = $_FILES['avatar'];
            $dirAvatar = 'storage/user-avatar/';

            // salvar avatar
            if($avatar['size'] != 0)
            {
                $nameAvatar = $storage->storage($avatar, $dirAvatar);
                $user->__set('avatar', $nameAvatar);
            }

            // salvar dados
            $user->__set('name', $data['name']);
            $user->__set('email', $data['email']);
            $user->__set('password', password_hash($data['password_confirmation'], PASSWORD_DEFAULT));
            $userInsert = $user->store();

            if(!empty($userInsert['id'])) {
                session_start();
                $_SESSION = $userInsert;
                $feedback = "successSession";
                header("Location: /?status=$feedback");
                exit;
            }
        } catch (Throwable $e) {
            $feedback = 'no-session';
            header("Location: /?status=$feedback");
            exit;
        }
    }

    public function logout(): void
    {
        session_start();

        if (isset($_SESSION['first_access']) && $_SESSION['first_access'] === 1) {
            $user = Container::getModel('User');
            $user->__set('first_access', 0);
            $user->updateAccess($_SESSION['id']);
        }

        session_destroy();
        $feedback = 'no-session';
        header("Location: /?feedback=$feedback");
        exit;
    }
}