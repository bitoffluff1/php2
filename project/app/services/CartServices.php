<?php

namespace App\services;

class CartServices
{
    public function getCart($request)
    {
        return $request->getSession("cart");
    }

    public function addItem($request, $item)
    {
        $id = $item->id;
        $cart = $request->getSession("cart");

        if (is_array($cart) && array_key_exists($id, $cart)) {
            $cart[$id]["quantity"]++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "address" => $item->address,
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => 1
            ];
        }

        $request->setSession("cart", $cart);
    }

    public function deleteItem($request, $id)
    {
        $cart = $request->getSession("cart");

        if (is_array($cart) && array_key_exists($id, $cart)) {
            $quantity = $cart[$id]["quantity"];

            if ($quantity === 1 || $request->getParams("get", "item") === "all") {
                unset($cart[$id]);
            } else {
                $cart[$id]["quantity"] = $quantity - 1;
            }
        }

        $request->setSession("cart", $cart);
    }

    public function clearCart($request)
    {
        $request->clearSession("cart");
    }


    public function getQuantityCart($request)
    {
        $quantity = 0;
        $cart = $request->getSession("cart");
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $quantity += $item["quantity"];
            }
        }
        return $quantity;
    }

}