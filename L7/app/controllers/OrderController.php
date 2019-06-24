<?php


namespace App\controllers;

use App\main\App;

class OrderController extends Controller
{
    protected $defaultAction = "order";

    /*public function orderAction()
    {
        $params = [
            "cart" => $this->services->getCart($this->request),
        ];

        echo $this->render("cart", $params);
    }*/

    public function addAction()
    {
        $user = $this->request->getSession("user");

        if(empty($user)){
            $params = [
                "message" => "Зарегестрируйтесь или войдите в свой профиль",
            ];
            echo $this->render("auth", $params);
            return;
        }

        $user_id = (int)$user["id"];
        $cart = $this->request->getSession("cart");
        $order_items = json_encode($cart, JSON_UNESCAPED_UNICODE);




        //$item =  App::call()->goodRepository->getOne($id);
        //if(empty($item)){
        //    $this->redirect();
        //    return;
        //}
//
        //$this->services->addItem($this->request, $item);
        //$this->redirect();
    }

    /*public function deleteAction()
    {
        $this->services->deleteItem($this->request, $this->getId());
        $this->redirect();
    }

    public function clearAction()
    {
        $this->services->clearCart($this->request);
        $this->redirect();
    }*/

}