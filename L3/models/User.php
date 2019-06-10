<?php

namespace App\models;


class User extends Model
{
    public $id;
    public $login;
    public $password;

    public function getTableName(): string
    {
        return "users";
    }
}