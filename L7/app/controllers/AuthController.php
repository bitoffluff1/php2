<?php


namespace App\controllers;

use App\main\App;

class AuthController extends Controller
{
    protected $defaultAction = "auth";

    public function authAction()
    {
        echo $this->render("auth");
    }

    public function loginAction()
    {
        $login = $this->request->getParams("post", "login");
        $salt = "ds1fe3atv435dafs435rf";
        $password = md5($this->request->getParams("post", "password") . $salt);

        if(empty($login) && empty($password)){
            $this->redirect();
            return;
        }

        $user = App::call()->userRepository->getUser($login);
        if(empty($user)){
            $this->redirect();
            return;
        }

        $user = $user->columns;

        if ($user["password"] === $password) {
            if ($user["role"] === "isAdmin") {
                $this->request->setSession("adminKey", "isAdmin");
            } else {
                $this->request->setSession("user", $user);
            }

            $params = [
                "user" => $user,
            ];
            echo $this->render("auth", $params);
        }
    }

    public function signUpAction(){
        $login = $this->request->getParams("post", "login");
        $salt = "ds1fe3atv435dafs435rf";
        $password = md5($this->request->getParams("post", "password") . $salt);

        if(empty($login) && empty($password)){
            $this->redirect();
            return;
        }


        $user = App::call()->userRepository->getUser($login);
        $user = $user->columns;
        if(!empty($user)){
            $params = [
                "message" => "Логин" . $user['login'] . "уже используется!",
            ];
            echo $this->render("auth", $params);

            return;
        }

        $admin = $this->request->getSession("adminKey");
        if(!empty($admin)){
            $user = App::call()->userRepository->newUser($login, $password, "isAdmin");
            $user = $user->columns;

            $this->request->setSession("adminKey", "isAdmin");

            $params = [
                "user" => $user,
            ];
            echo $this->render("auth", $params);

            return;
        }

        $user = App::call()->userRepository->newUser($login, $password);
        $user = $user->columns;
        $this->request->setSession("user", $user);

        $params = [
            "user" => $user,
        ];
        echo $this->render("auth", $params);

    }

    public function logoutAction(){
        $this->request->destroySession();
        $this->redirect("/auth");
    }
}