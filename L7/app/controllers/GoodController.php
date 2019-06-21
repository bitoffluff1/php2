<?php


namespace App\controllers;

use App\main\App;

class GoodController extends Controller
{
    protected $defaultAction = "goods";

    public function goodAction()
    {
        $params = [
            "good" => App::call()->goodRepository->getOne($this->getId()),
        ];

        echo $this->render("good", $params);
    }

    public function goodsAction()
    {
        $params = [
            "goods" => App::call()->goodRepository->getAll(),
        ];

        echo $this->render("goods", $params);
    }
}