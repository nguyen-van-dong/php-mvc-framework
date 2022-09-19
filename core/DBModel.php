<?php

namespace app\core;

abstract class DBModel extends Model
{
    abstract public function tableName();

    abstract public function attributes(): array;

    /**
     * @return bool
     */
    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $sql = "INSERT INTO $tableName (". implode(',', $attributes).") VALUES (". implode(',', $params) .")";
        $statement = self::prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    /**
     * @param $sql
     * @return \PDOStatement
     */
    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->prepare($sql);
    }

    /**
     * @param $where
     * @return mixed
     */
    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        $tableName = static::tableName();
        $attributes = static::attributes();
        $sql = implode(", ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $sql = "UPDATE $tableName SET $sql WHERE id=:id";
        $statement= self::prepare($sql);
        $statement->bindValue(':id', $this->id);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    /**
     * @return int
     */
    public function delete(): int
    {
        $tableName = static::tableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        $statement= self::prepare($sql);
        $statement->bindValue(':id', $this->id);
        $statement->execute();

        return $statement->rowCount();
    }
}