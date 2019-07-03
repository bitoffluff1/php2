<?php


namespace App\controllers;

use App\main\App;

class GoodController extends Controller
{
    protected $defaultAction = "goods";

    public function goodAction()
    {
        App::call()->goodRepository->increaseViews($this->getId());

        $params = [
            "good" => App::call()->goodRepository->getOne($this->getId()),
            "reviews" => App::call()->reviewRepository->getGoodReviews($this->getId()),
            "user" => $this->checkUser(),
        ];

        echo $this->render("good", $params);
    }

    public function goodsAction()
    {
        $params = [
            "user" => $this->checkUser(),
        ];

        echo $this->render("goods", $params);
    }

    public function deleteAction()
    {
        $this->isAdmin();

        $data = ["id" => $this->getId(), "stock" => "1"];
        App::call()->goodServices->changeGood($data);

        $this->redirect("/good");
    }

    public function changeAction()
    {
        $this->isAdmin();

        $params = $this->request->getParams("post");
        foreach ($params as $value) {
            if (empty($value)) {
                $this->redirect();
            }
        }

        App::call()->goodServices->changeGood($params);

        $this->redirect();
    }

    public function addAction()
    {
        $this->isAdmin();

        App::call()->goodServices->copyFile();

        $params = $this->request->getParams("post");
        $params["address"] = "img/{$_FILES['userfile']['name']}";
        foreach ($params as $key => $value) {
            if (empty($value)) {
                $this->redirect();
            }
        }

        App::call()->goodServices->changeGood($params);

        $this->redirect();
    }

    public function getOptionsAction()
    {
        $data = json_decode(trim(file_get_contents("php://input")), true);

        $options = App::call()->goodServices->getOptions($data);

        $user = $this->checkUser();
        $sql = App::call()->goodServices->getSql($options, $user);

        $goods = App::call()->goodRepository->getAll($sql);

        $items = [];
        foreach ($goods as $value) {
            $items[] = $value->columns;
        }
        echo $decoded = json_encode($items, JSON_UNESCAPED_UNICODE);
    }

    public function getMaxPriceAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = $this->checkUser();
            if ($user["role"] === "isAdmin") {
                $goods = App::call()->goodRepository->getAll();
            } else {
                $sql = "SELECT * FROM gallery WHERE stock = '2'";
                $goods = App::call()->goodRepository->getAll($sql);
            }

            $goodsPrice = [];
            foreach ($goods as $value) {
                $goodsPrice[] = (int)$value->columns["price"];
            }

            echo $maxPrice = max($goodsPrice);
        }
    }
}