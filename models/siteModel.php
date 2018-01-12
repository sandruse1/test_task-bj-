<?php

class siteModel
{
    public static function CreateDB(){

        Db::createTable('user');
        Db::createTable('task');

        if (!file_exists(ROOT.'/public/images')) {
            Db::insertTable('user');
            mkdir(ROOT . '/public/images', 0700);
        }
    }

}