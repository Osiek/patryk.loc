<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 09:36
 */

class Equipment extends BaseModel
{
    protected $id;
    protected $name;

    public static function withName($name, Database $db) {
        $result = $db->getRowIdFromRecordIfExists("equipment", "name", $name);
        if (!$result) {
            return new self(self::create($name, $db), $name);
        } else {
            return new self($result[0], $result[1]);
        }
    }

    public static function create($name, Database $db) {
        $stmt = $db->dbh->prepare("INSERT INTO equipment (name) VALUES (:equipment_name)");
        $stmt->bindParam(":equipment_name", $name);
        $result = $stmt->execute();
        return $db->dbh->lastInsertId();
    }

    public static function withId($id, Database $db) {
        $result = $db->getRowNameFromId("equipment", $id);
        return new self($result[0], $result[1]);
    }

    public static function getForSpecificCar($carId, $db) {
        $equipments = array();
        $equipment = $db->dbh->prepare("SELECT  equipment.id as equipment_id, 
                                                equipment.name as equipment_name
                                        FROM equipment
                                        INNER JOIN car_equipment ON car_equipment.equipmentid=equipment.id
                                        WHERE car_equipment.carid = :carId");
        $equipment->bindParam(':carId', $carId);
        $equipment->execute();
        $results = $equipment->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $r) {
            array_push($equipments, new Equipment($r['equipment_id'], $r['equipment_name']));
        }

        return $equipments;
    }
}