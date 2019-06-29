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
        $user = $this->checkUser();
        if ($user["role"] === "isAdmin") {
            $goods = App::call()->goodRepository->getAll();
        } else {
            $sql = App::call()->goodServices->getSql($this->request);
            $goods = App::call()->goodRepository->getAll($sql);
        }

        $goodsPrice = [];
        foreach ($goods as $value) {
            $goodsPrice[] = (int)$value->columns["price"];
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo $maxPrice = max($goodsPrice);
            exit;
        }

        $params = [
            "goods" => $goods,
            "user" => $user,
            "goodsPrice" => $goodsPrice,
        ];

        echo $this->render("goods", $params);
    }

    public function deleteAction()
    {
        $this->isAdmin();

        $data = ["id" => $this->getId(), "stock" => "0"];
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

        $category = (!empty($data["category"])) ? $data["category"] : 0;
        $size = (!empty($data["size"])) ? implode($data["size"], "','") : null;
        $price = (!empty($data["price"])) ? $data["price"] : 0;

        $sort = (!empty($data["sort"])) ? $data["sort"] : "count_desc";
        $sort = explode('_', $sort);
        $sortBy = $sort[0];
        $sortDir = $sort[1];

        $data = [
            "category" => $category,
            "size" => $size,
            "price" => $price,
            "sortBy" => $sortBy,
            "sortDir" => $sortDir
        ];

        $categoryWhere =
            ($category !== 0)
                ? "category = '$category' and "
                : "";

        $brandsWhere =
            ($size !== null)
                ? "size in ('$size') and "
                : "";

        $sql = "SELECT * FROM gallery WHERE stock = '1' AND $categoryWhere $brandsWhere price BETWEEN '0' AND '$price' ORDER BY $sortBy $sortDir";

        $goods = App::call()->goodRepository->getAll($sql);
        $user = $this->checkUser();
        $items = [];
        foreach ($goods as $value) {
            $items[] = $value->columns;
        }


        /*$params = [
            "goods" => $goods,
            "user" => $user,
            "goodsPrice" => $goodsPrice,
        ];

        echo $this->render("goods", $params);*/

        echo $decoded = json_encode($items, JSON_UNESCAPED_UNICODE);
    }
}