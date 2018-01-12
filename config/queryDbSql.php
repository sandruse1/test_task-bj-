<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 10.07.17
 * Time: 10:57
 */

$query = array(
    'createUser' => 'CREATE TABLE IF NOT EXISTS `user` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, login VARCHAR(60) NOT NULL, email VARCHAR(60) , passwd VARCHAR(500) NOT NULL, admin INT DEFAULT 0)',
    'insertUser' =>  'INSERT INTO `user` (login, email, passwd, admin) VALUES ("admin", "", "344907e89b981caf221d05f597eb57a6af408f15f4dd7895bbd1b96a2938ec24a7dcf23acb94ece0b6d7b0640358bc56bdb448194b9305311aff038a834a079f", 1)',
    'createTask' => 'CREATE TABLE IF NOT EXISTS `task` (id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL, user_name VARCHAR(60) NOT NULL, task_text VARCHAR(10000) NOT NULL, user_email VARCHAR(60) NOT NULL, status INT DEFAULT 0 , img_src VARCHAR(555) DEFAULT "")',
);

return ($query);