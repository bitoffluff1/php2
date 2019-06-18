<?php

//пространство имен - это способ инкапсуляции элементов
namespace App\models;

use App\services\Db;
use App\services\IDb;

/**
 * Class Model
 * @property string $tableName Свойство для наследников
 * @property integer $id Поле из наследников
 */
abstract class Model implements IModel//от этого класса нельзя создать объект
{
    private $db;
    protected $columns = [];

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
     * @return object
     */
    public static function getOne($id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        return Db::getInstance()->getObject($sql, get_called_class(), [":id" => $id]);
    }

    /**
     * Получение всех записей
     *
     * @return array
     */
    public static function getAll()
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";
        return Db::getInstance()->getObjects($sql, get_called_class());
    }

    public function delete()
    {
        $table = static::getTableName();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $this->db->execute($sql, [":id" => $this->id]);
    }

    protected function insert()
    {
        $columns = [];
        $params = [];
        foreach ($this->columns as $key => $value) {
            if (!empty($value)) {
                $columns[] = $key;
                $params[":{$key}"] = $value;
            }
        }
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $table = static::getTableName();
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = (integer)$this->db->getLastId();
    }

    protected function update()
    {
        $array = [];
        foreach ($this->columns as $key => $value) {
            if (!empty($value) || $key !== "id") {
                $str = "{$key} = '{$value}'";
                $array[] = $str;
            }
        }
        $str = implode(",", $array);
        $table = static::getTableName();

        $sql = "UPDATE {$table} SET {$str} WHERE id = :id";
        $this->db->execute($sql, [":id" => $this->id]);
    }

    public function save()
    {
        $this->id ? $this->update() : $this->insert();
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->columns)) {
            return $this->columns[$name];
        }
        return false;
    }

    public function __set($name, $value){
        if (array_key_exists($name, $this->columns)) {
            $this->columns[$name] = $value;
        }
    }
}