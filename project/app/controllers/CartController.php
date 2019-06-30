<?php


namespace App\controllers;

use App\main\App;

class CartController extends Controller
{
    protected $defaultAction = "cart";

    public function cartAction()
    {
        $cart = App::call()->cartServices->getCart($this->request);
        $total = 0;
        foreach ($cart as $good){
            $total += $good["price"] * $good["quantity"];
        }

        $params = [
            "cart" => $cart,
            "total" => $total,
        ];

        echo $this->render("cart", $params);
    }

    public function addAction()
    {
        $id = $this->getId();
        if(empty($id)){
            $this->redirect();
            return;
        }

        $item =  App::call()->goodRepository->getOne($id);
        if(empty($item)){
            $this->redirect();
            return;
        }

        App::call()->cartServices->addItem($this->request, $item);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->getQuantityCartAction();
            exit;
        }

        $this->redirect();
    }

    public function deleteAction()
    {
        App::call()->cartServices->deleteItem($this->request, $this->getId());
        $this->redirect();
    }

    public function clearAction()
    {
        App::call()->cartServices->clearCart($this->request);
        $this->redirect();
    }

    public function getQuantityCartAction(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo $quantity =  App::call()->cartServices->getQuantityCart($this->request);
        }
    }

}