<?php

namespace App\models;

class Good extends Model
{
    use \App\traits\Calc;

    public $id;
    public $address;
    public $name;
    public $price;
    public $count;

    public function getTableName(): string
    {
        return "gallery";
    }
}