<?php
include_once ROOT . '/models/TaskModel.php';
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.01.2018
 * Time: 19:25
 */
class TaskController
{
    public function actionAdd_task() {
        TaskModel::add($_POST, $_FILES);
        return (true);
    }

    public function actionSet()
    {
        TaskModel::edit($_POST);
        return (true);
    }

    public function actionGet_task(){
        TaskModel::get_per_page($_POST);
        return (true);
    }

    public function actionTask_count(){
        TaskModel::get_task_count();
        return (true);
    }
}