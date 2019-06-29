<?php

namespace App\models\repositories;

use App\main\App;
use App\models\entities\Order;

class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return "orders";
    }

    protected function getEntityClass()
    {
        return Order::class;
    }

    public function changeStatusOrder($status, $id)
    {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        App::call()->db->execute($sql, [":id" => $id, ":status" => $status]);
    }

    public function getUserOrders($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC";
        return App::call()->db->getObjects($sql, $this->getEntityClass(), [":user_id" => $user_id]);
    }
}