<?php


namespace App\models;


class Review extends Model
{
    public $id;
    public $name;
    public $text;
    public $id_product;

    public static function getTableName(): string
    {
        return "reviews";
    }
}