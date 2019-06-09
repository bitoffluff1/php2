<?php


namespace App\services;


class Db implements IDb
{
    /**
     * Поиск конкретной записи
     *
     * @param string $sql
     * @return string
     */
    public function find(string $sql) :string
    {
        return "";
    }

    /**
     * Поиск всех записей
     *
     * @param string $sql
     * @return array
     */
    public function findAll(string $sql) :array
    {
        return [];
    }
}