<?php
include_once ROOT . '/models/Auth.php';
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.01.2018
 * Time: 16:59
 */
class AuthController
{
    public function actionSign_up()
    {
        Auth::signup($_POST);
        return (true);
    }

    public function actionSign_in()
    {
        Auth::signin($_POST);
        return (true);
    }

    public function actionLogout()
    {
        Auth::logout($_POST);
        return (true);
    }
}