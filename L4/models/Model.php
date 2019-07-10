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
        $names = $this->getNamesColumns();
        $columns = [];
        $params = [];
        foreach ($this as $key => $value) {
            if(!in_array($key, $names)){
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
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
        $names = $this->getNamesColumns();
        $array = [];
        foreach ($this as $key => $value) {
            if(!in_array($key, $names)){
                continue;
            }
            if (!empty($value) && $key !== "id") {
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

    protected function getNamesColumns()
    {
        $table = static::getTableName();
        $sql = "SELECT COLUMN_NAME FROM COLUMNS WHERE TABLE_NAME = '{$table}' AND TABLE_SCHEMA = 'gbphp'";

        $connection = new \PDO(
            "mysql:host=localhost;dbname=information_schema;charset=utf8",
            "root", "");
        $connection->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_ASSOC
        );

        $PDOStatement = $connection->prepare($sql);
        $PDOStatement->execute();
        $array = $PDOStatement->fetchAll();

        $names = [];
        foreach ($array as $value){
            if(is_array($value)){
                foreach ($value as $name){
                    $names[] = $name;
                }
            }
        }
        return $names;
    }
}