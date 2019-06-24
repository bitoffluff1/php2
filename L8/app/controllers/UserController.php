<?php

namespace App\controllers;

use App\main\App;

class UserController extends Controller
{
    protected $defaultAction = "users";

    public function userAction()
    {
        $this->isAdmin();

        $params = [
            "user" => App::call()->userRepository->getOne($this->getId()),
            "userNow" => $this->checkUser(),
        ];

        echo $this->render("user", $params);
    }

    public function usersAction()
    {
        $this->isAdmin();

        $params = [
            "users" => App::call()->userRepository->getAll(),
            "userNow" => $this->checkUser(),
        ];

        echo $this->render("users", $params);
    }

    public function deleteAction(){
        $this->isAdmin();

        $user = App::call()->userRepository->newEntity(["id" => $this->getId()]);
        App::call()->userRepository->delete($user);

        $this->redirect("/user");
    }

}