<?php


namespace App\controllers;

use App\main\App;

class CartController extends Controller
{
    protected $defaultAction = "cart";

    public function cartAction()
    {
        $params = [
            "cart" => App::call()->cartServices->getCart($this->request),
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

}