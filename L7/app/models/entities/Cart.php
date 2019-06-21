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
class Cart extends Entity
{
    public $columns = [
        "id" => "",
        "address" => "",
        "name" => "",
        "price" => "",
    ];
}