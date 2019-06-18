<?php

namespace App\models;

//use App\traits\Calc;
/**
 * Class Good
 * @package App\models
 * @property $id
 * @property $address
 * @property $name
 * @property $price
 */
class Good extends Model
{
    //use Calc;
    protected $columns = [
        "id" => "",
        "address" => "",
        "name" => "",
        "price" => "",
    ];

    public static function getTableName(): string
    {
        return "gallery";
    }


}