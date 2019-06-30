<?php

namespace App\models\entities;

/**
 * Class Good
 * @package App\models\entities
 *
 * @property $id
 * @property $address
 * @property $name
 * @property $price
 */
class Good extends Entity
{
    public $columns = [
        "id" => "",
        "address" => "",
        "name" => "",
        "price" => "",
        "count" => "",
        "stock" => "",
        "category" => "",
        "size" => ""
    ];
}