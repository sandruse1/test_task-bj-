<?php

/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.01.2018
 * Time: 14:06
 */
class Auth
{
    public static function signup($data) {
        $pdo = Db::getConnection();
        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $query_login = $pdo->prepare("SELECT * FROM `user` WHERE login = '$name'");
        $query_email = $pdo->prepare("SELECT * FROM `user` WHERE email = '$email'");
        $query_login->execute();
        $result_login = $query_login->fetchAll();
        $query_email->execute();
        $result_email = $query_email->fetchAll();
        if ($result_login == NULL && $result_email == NULL) {
            $query = $pdo->prepare("INSERT INTO `user` (login, email, passwd, admin) VALUES (?, ?, ?, ?)");
            $query->execute([$name, $email, hash('whirlpool', $password), 0]);
            $session = Session::getInstance();
            $session->logged_user = $name;
            $session->user_email = $email;
            $session->is_admin = 0;
            echo "OK";
        } else {
            echo "Name or email already exists";
        }
    }

    public static function signin($data) {
        $pdo = Db::getConnection();
        $name = $data['name'];
        $password = $data['password'];
        $query_login = $pdo->prepare("SELECT * FROM `user` WHERE login = '$name'");
        $query_login->execute();
        $result_login = $query_login->fetchAll();
        if ($result_login) {
            if (hash('whirlpool', $password) == $result_login[0]["passwd"]) {
                $session = Session::getInstance();
                $session->logged_user = $name;
                $session->user_email = $result_login[0]["email"];
                $session->is_admin = $result_login[0]["admin"];
                echo "OK";
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "No such user";
        }
    }

    public static function logout() {
        $session = Session::getInstance();
        $session->destroy();
        header("Location: http://localhost:8080");
    }
}