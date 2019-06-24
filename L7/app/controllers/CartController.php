<?php


namespace App\controllers;

use App\main\App;

class CartController extends Controller
{
    protected $defaultAction = "cart";
    protected $services;

    public function __construct($render, $request)
    {
        parent::__construct($render, $request);
        $this->services = App::call()->cartServices;
    }

    public function cartAction()
    {
        $params = [
            "cart" => $this->services->getCart($this->request),
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

        $this->services->addItem($this->request, $item);
        $this->redirect();
    }

    public function deleteAction()
    {
        $this->services->deleteItem($this->request, $this->getId());
        $this->redirect();
    }

    public function clearAction()
    {
        $this->services->clearCart($this->request);
        $this->redirect();
    }

}