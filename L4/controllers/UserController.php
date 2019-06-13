<?php

namespace App\controllers;

use App\models\User;
use App\traits\TController;

class UserController
{
    use TController;

    public $defaultAction = "users";

    public function userAction()
    {
        $id = (int)$_GET["id"];
        $params = [
            "user" => User::getOne($id),
        ];

        echo $this->render("user", $params);
    }

    public function usersAction()
    {
        $params = [
            "users" => User::getAll(),
        ];

        echo $this->render("users", $params);
    }
}