<?php


namespace App\services;


class CartServices
{
    public function getCart(){
        return $_SESSION["cart"];
    }

    public function addItem($params){
        $id = $params->id;

        if (!empty($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]["quantity"]++;

        } else {
            $_SESSION["cart"][$id] = [
                "id" => $params->id,
                "address" => $params->address,
                "name" => $params->name,
                "price" => $params->price,
                "quantity" => 1
            ];
        }

        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }

    public function deleteItem($id){
        if (!empty($_SESSION["cart"][$id])) {
            $quantity = $_SESSION["cart"][$id]['quantity'];

            if ($quantity === 1) {
                unset($_SESSION["cart"][$id]);
            } else {
                $_SESSION["cart"][$id]['quantity'] = $quantity - 1;
            }
        }
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }

    public function clearCart(){
        unset($_SESSION["cart"]);
        header('Location: ' . $_SERVER["HTTP_REFERER"]);
    }

}