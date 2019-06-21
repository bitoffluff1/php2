<?php

namespace App\controllers;

use App\main\App;

class UserController extends Controller
{
    protected $defaultAction = "users";

    public function userAction()
    {
        $params = [
            "user" => App::call()->userRepository->getOne($this->getId()),
        ];

        echo $this->render("user", $params);
    }

    public function usersAction()
    {
        $params = [
            "users" => App::call()->userRepository->getAll(),
        ];

        echo $this->render("users", $params);
    }

}