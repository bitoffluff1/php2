<?php


namespace App\controllers;

use App\models\repositories\CartRepository;
use App\services\CartServices;
use App\services\Request;

class CartController extends Controller
{
    protected $defaultAction = "cart";
    public $services;

    public function __construct($render, $request)
    {
        parent::__construct($render, $request);
        $this->services = new CartServices;
    }

    public function cartAction()
    {
        $params = [
            "cart" => $this->services->getCart(),
        ];

        echo $this->render("cart", $params);
    }

    public function addAction()
    {
        $params = $this->request->getGets();
        $id = $params["id"];

        $item = (new CartRepository())->getOne($id);
        $this->services->addItem($item);
    }

    public function deleteAction()
    {
        $params = $this->request->getGets();
        $id = $params["id"];

        $this->services->deleteItem($id);
    }

    public function clearAction(){
        $this->services->clearCart();
    }

}