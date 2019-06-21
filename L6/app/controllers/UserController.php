<?php

namespace App\controllers;

use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = "users";

    public function userAction()
    {
        $params = $this->request->getGets();
        $id = $params["id"];

        $params = [
            "user" => (new UserRepository())->getOne($id),
        ];

        echo $this->render("user", $params);
    }

    public function usersAction()
    {
        $params = [
            "users" => (new UserRepository())->getAll(),
        ];

        echo $this->render("users", $params);
    }
    public function errorAction()
    {
        echo $this->render("error");
    }
}