<?php


namespace App\controllers;

use App\main\App;

class OrderController extends Controller
{
    protected $defaultAction = "orders";

    public function ordersAction()
    {
        $this->isAdmin();

        $orders = App::call()->orderRepository->getAll();
        $orders = App::call()->orderServices->decodeCart($orders);
        $orders = App::call()->orderServices->getSumOrder($orders);

        $params = [
            "orders" => $orders,
            "user" => $this->checkUser(),
        ];

        echo $this->render("order", $params);
    }

    public function addAction()
    {
        $user = $this->checkUser();
        if (empty($user)) {
            $params = [
                "message" => "Login to place an order",
            ];
            echo $this->render("auth", $params);
            return;
        }

        $user_id = (int)$user["id"];
        $cart = $this->request->getSession("cart");
        if (empty($cart)) {
            $this->redirect();
            return;
        }

        $order_items = json_encode($cart, JSON_UNESCAPED_UNICODE);
        $data = ["user_id" => $user_id, "order_items" => $order_items];

        if (!empty($this->request->getParams("post", "comment"))) {
            $data["comment"] = $this->request->getParams("post", "comment");
        }

        $newOrder = App::call()->orderServices->saveOrder($data);

        $this->request->clearSession("cart");

        $params = [
            "message" => "Order is accepted. His number: " . $newOrder->columns['id'],
        ];
        echo $this->render("cart", $params);
    }

    public function changeStatusAction()
    {
        $this->isAdmin();

        $status = $this->request->getParams("post", "status");
        $id = (int)$this->request->getParams("post", "id");

        App::call()->orderRepository->changeStatusOrder($status, $id);
        $this->redirect();
    }

    public function userOrdersAction()
    {
        $user = $this->checkUser();
        if (empty($user)) {
            $params = [
                "message" => "Login to place an order",
            ];
            echo $this->render("auth", $params);
            return;
        }

        $orders = App::call()->orderRepository->getUserOrders($user["id"]);
        $orders = App::call()->orderServices->decodeCart($orders);
        $orders = App::call()->orderServices->getSumOrder($orders);

        $params = [
            "orders" => $orders,
            "user" => $user,
        ];

        echo $this->render("order", $params);
    }

}