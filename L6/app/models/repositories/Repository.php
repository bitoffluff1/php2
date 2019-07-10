<?php

//пространство имен - это способ инкапсуляции элементов
namespace App\models\repositories;

use App\models\entities\Entity;
use App\services\Db;

abstract class Repository implements IRepository//от этого класса нельзя создать объект
{
    private $db;

    /**
     * Good constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    abstract protected function getEntityClass();

    /**
     * Получение конкретной записи
     *
     * @param $id
     * @return object
     */
    public function getOne($id)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return Db::getInstance()->getObject($sql, $this->getEntityClass(), [":id" => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array
     */
    public function getAll()
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        return Db::getInstance()->getObjects($sql, $this->getEntityClass());
    }

    public function delete(Entity $entity)
    {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $this->db->execute($sql, [":id" => $entity->id]);
    }

    protected function insert(Entity $entity)
    {
        var_dump(789);
        $columns = [];
        $params = [];
        foreach ($entity->columns as $key => $value) {
            if (!empty($value)) {
                $columns[] = $key;
                $params[":{$key}"] = $value;
            }
        }
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = $this->getTableName();
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $entity->id = (integer)$this->db->getLastId();
    }

    protected function update(Entity $entity)
    {
        var_dump(123);
        $array = [];
        foreach ($entity->columns as $key => $value) {
            if (!empty($value) || $key !== "id") {
                $str = "{$key} = '{$value}'";
                $array[] = $str;
            }
        }
        $str = implode(",", $array);
        $table = $this->getTableName();

        $sql = "UPDATE {$table} SET {$str} WHERE id = :id";
        $this->db->execute($sql, [":id" => $entity->id]);
    }

    public function save(Entity $entity)
    {
        var_dump($entity);
        $entity->id ? $this->update($entity) : $this->insert($entity);
    }
}