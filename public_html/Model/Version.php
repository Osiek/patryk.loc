<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 09:36
 */

class Version extends BaseModel
{
    protected $id;
    protected $name;

    public static function withName($name, Database $db) {
        $result = $db->getRowIdFromRecordIfExists("version", "name", $name);
        if (!$result) {
            return new self(self::create($name, $db), $name);
        } else {
            return new self($result[0], $result[1]);
        }
    }

    public static function create($name, Database $db) {
        $stmt = $db->dbh->prepare("INSERT INTO version (name) VALUES (:version_name)");

        $stmt->bindParam(":color_name", $name);
        $result = $stmt->execute();

        return $db->dbh->lastInsertId();
    }

    public static function withId($id, Database $db) {
        $result = $db->getRowNameFromId("version", $id);

        return new self($result[0], $result[1]);
    }
}