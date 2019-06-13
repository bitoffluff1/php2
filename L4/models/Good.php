<?php

namespace App\models;

use App\traits\Calc;

class Good extends Model
{
    use Calc;

    public $id;
    public $address;
    public $name;
    public $price;

    public static function getTableName(): string
    {
        return "gallery";
    }
}