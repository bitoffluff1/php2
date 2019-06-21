<?php


namespace App\controllers;

use App\models\repositories\GoodRepository;

class GoodController extends Controller
{
    protected $defaultAction = "goods";

    public function goodAction()
    {
        $params = $this->request->getGets();
        $id = $params["id"];

        $params = [
            "good" => (new GoodRepository())->getOne($id),
        ];

        echo $this->render("good", $params);
    }

    public function goodsAction()
    {
        $params = [
            "goods" => (new GoodRepository())->getAll(),
        ];

        echo $this->render("goods", $params);
    }
}