<?php

namespace App\models;

/**
 * Class User
 * @package App\models
 * @property $id
 * @property $login
 * @property $password
 */
class User extends Model
{
    protected $columns = [
        "id" => "",
        "login" => "",
        "password" => ""
    ];

    public static function getTableName(): string
    {
        return "users";
    }
}