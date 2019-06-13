<?php


namespace App\controllers;

use App\models\Good;
use App\traits\TController;

class GoodController
{
    use TController;

    public $defaultAction = "goods";

    public function goodAction()
    {
        $id = (int)$_GET["id"];
        $params = [
            "good" => Good::getOne($id),
        ];

        echo $this->render("good", $params);
    }

    public function goodsAction()
    {
        $params = [
            "goods" => Good::getAll(),
        ];

        echo $this->render("goods", $params);
    }
}