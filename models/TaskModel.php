<?php
include(ROOT.'/models/SimpleImage.php');
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.01.2018
 * Time: 19:26
 */
class TaskModel
{
    public static function add($data, $file) {
        $pdo = Db::getConnection();
        $user_name = $data['name'];
        $user_email = $data['email'];
        $task = $data['task'];
        if ($file) {
            $target_dir = "./public/images/";
            $target_file = $target_dir . basename($file["img"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = getimagesize($file["img"]["tmp_name"]);
            if ($check) {
                if ($imageFileType != "jpg" && $imageFileType != "jpeg"&& $imageFileType != "png" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, PNG & GIF files are allowed.";
                } else {
                    if (move_uploaded_file($file["img"]["tmp_name"], $target_file)) {
                        $image = new SimpleImage();
                        $image->load($target_file);
                        $image->resize(320, 240);
                        $image->save($target_file);
                        $query = $pdo->prepare("INSERT INTO `task` (user_name, user_email, task_text, img_src) VALUES (?, ?, ?, ?)");
                        $query->execute([$user_name, $user_email, $task, $target_file]);
                        echo "OK";

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo "File is not an image.";
            }
        } else {
            $query = $pdo->prepare("INSERT INTO `task` (user_name, user_email, task_text) VALUES (?, ?, ?)");
            $query->execute([$user_name, $user_email, $task]);
            echo "OK";
        }
    }
    public static function edit($data) {
        $pdo = Db::getConnection();
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $task = $data['task'];
        $done = ($data['done'] == "Done") ? 1 : 0;
        $query = $pdo->prepare("UPDATE `task` SET user_name='$name', user_email='$email', task_text='$task', status=".$done." WHERE id = '$id'");
        $query->execute();
        echo "OK";
    }

    public static function get_per_page($data){
        $pdo = Db::getConnection();
        $session = Session::getInstance();
        $page = $data['page'];
        $sort = ($data['sort']) ? "ORDER BY  ".$data['sort'] : "";
        $sort = ($data['sort'] == 'status') ? $sort." DESC" : $sort;
        $limit_start = ($page - 1) * 3;

        $query = $pdo->prepare("SELECT * FROM `task` ".$sort." LIMIT ".$limit_start.",3");
        $query->execute();
        $result = $query->fetchAll();
        $result[] = ($session->is_admin == null) ? "0" : $session->is_admin;
        echo json_encode($result);
    }

    public static function get_task_count(){
        $pdo = Db::getConnection();
        $session = Session::getInstance();
        $query = $pdo->prepare("SELECT * FROM `task`");
        $query->execute();
        $result = $query->fetchAll();
        $count = count($result) / 3;

        $query = $pdo->prepare("SELECT * FROM `task` LIMIT 3");
        $query->execute();
        $result = $query->fetchAll();
        $result[] = ($session->is_admin == null) ? "0" : $session->is_admin;
        $result[] = $count;
        echo json_encode($result);
    }

}