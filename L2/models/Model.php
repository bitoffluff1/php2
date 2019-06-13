<?php


namespace App\models;


use App\services\IDb;


/**
 * Class Model
 * @property string $tableName Свойство для наследников
 */
abstract class Model implements IModel//от этого класса нельзя создать объект
{
    private $db;

    /**
     *
     * Good constructor.
     * @param Db $bd Экземпляр класса Db
     */
    public function __construct(IDb $bd)
    {
        $this->db = $bd;
    }

    /**
     *
     * Получение конкретной записи
     *
     * @param $id
     * @return string
     */
    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this -> getTableName()} WHERE id = $id";
        return $this->db->find($sql);
    }

    /**
     *
     * Получение всех записей
     *
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT * FROM {$this -> getTableName()}";
        return $this->db->findAll($sql);
    }
}