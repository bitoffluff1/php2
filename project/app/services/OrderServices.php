<?php


namespace App\services;


use App\main\App;

class OrderServices
{
    public function decodeCart($orders)
    {
        foreach ($orders as $item) {
            $cart = json_decode($item->columns["order_items"], true);
            $item->columns["order_items"] = $cart;
        }
        return $orders;
    }

    public function saveOrder($data){
        $order = App::call()->orderRepository->newEntity($data);
        App::call()->orderRepository->save($order);
        return $order;
    }

    public function getSumOrder($orders){
        $total = 0;
        foreach ($orders as $value) {
            foreach ($value->columns["order_items"] as $item) {
                $total += $item["quantity"] * (int)$item["price"];
            }
            $value->columns["total"] = $total;
            $total = 0;
        }
        return $orders;
    }

}