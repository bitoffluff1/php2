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

    public function getTableName(): string
    {
        return "gallery";
    }
    public function check(){
        $array = [];
        foreach ($this as $key => $value){
            if(!empty($value)){
                $str = "{$key} = '{$value}'";
                $array[] = $str;
            }
        }
        $str = implode(",", $array);
        return $str;
    }
}