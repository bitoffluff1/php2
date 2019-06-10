<?php

//пространство имен - это способ инкапсуляции элементов
namespace App\models;

use App\services\Db;
use App\services\IDb;

/**
 * Class Model
 * @property string $tableName Свойство для наследников
 */
abstract class Model implements IModel//от этого класса нельзя создать объект
{
    private $db;

    /**
     * Good constructor.
     * @param IDb $bd Экземпляр класса Db
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Получение конкретной записи
     *
     * @param $id
     * @return array
     */
    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this -> getTableName()} WHERE id = :id";
        return $this->db->getObject($sql, get_called_class(), [":id" => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this -> getTableName()}";
        return $this->db->getObjects($sql, get_called_class());
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this -> getTableName()} WHERE id = :id";
        return $this->db->delete($sql, [":id" => $id]);
    }

    public function update($id)
    {
        $sql = "UPDATE {$this -> getTableName()} SET {$this -> check()} WHERE id = :id";
        return $this->db->update($sql, [":id" => $id]);
    }
}