<?php

include_once ROOT.'/models/siteModel.php';

class SiteController
{
    public function actionStartpage()
    {
        siteModel::CreateDB();
        require_once(ROOT.'/views/viewMain.php');
        return true;
    }

    public function actionEditpage()
    {
        require_once(ROOT.'/views/viewEdit_task.php');
        return true;
    }

    public function actionSign_up(){

    }

    public function actionSignup() {
        ModelAuth::signup($_POST);
        return (true);
    }
    public function actionSignin() {
        ModelAuth::signin($_POST);
        return (true);
    }
    public function actionLogout() {
        ModelAuth::logout($_POST);
        return (true);
    }

}