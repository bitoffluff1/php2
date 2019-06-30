<?php

namespace App\models\entities;

class Order extends Entity
{
    public $columns = [
        "id" => "",
        "user_id" => "",
        "date" => "",
        "comments" => "",
        "order_items" => "",
        "status" => "",
    ];
}