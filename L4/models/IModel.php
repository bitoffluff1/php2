<?php


namespace App\models;


interface IModel
{
    /**
     * Данный метод должен вернуть имя таблицы
     *
     * @return string
     */
    public static function getTableName(): string;
}