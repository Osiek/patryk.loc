<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 10:26
 */

class Content
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getObjects($tableName, $parentId = null)
    {
        $objects = array();
        $className = ucfirst($tableName);

        $table = "";
        switch ($tableName) {
            case "color" : $table = "color";
                break;
            case "equipment" : $table = "equipment";
                break;
            case "make" : $table = "make";
                break;
            case "model" : $table = "model";
                break;
            case "version" : $table = "version";
                break;
        }

        if ($parentId === null) $queryString = "SELECT id, name FROM $table ORDER BY name ASC";
        else {
            $queryString = "SELECT id, name FROM $table WHERE parentid = :parent_id ORDER BY name ASC";
        }

        $stmt = $this->db->dbh->prepare($queryString);
        if ($parentId !== null) {
            $stmt->bindParam(":parent_id", $parentId);
        }

        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach ($rows as $r) {
            array_push($objects, new $className($r[0], $r[1]));
        }

        return $objects;

    }

    public function getAllCars() {
        $cars = array();
        $query = "  SELECT  car.id as car_id,
                    car.title as car_title, 
                    car.manufactured as car_manufactured, 
                    color.id as color_id,
                    color.name as color_name, 
                    make.id as make_id,
                    make.name as make_name, 
                    model.id as model_id,
                    model.name as model_name, 
                    version.id as version_id,
                    version.name as version_name, 
                    image.id as image_id,
                    image.path as image_filename
                    FROM car 
                    INNER JOIN color ON car.colorid=color.id
                    INNER JOIN make ON car.makeid=make.id
                    INNER JOIN model ON car.modelid=model.id
                    INNER JOIN version ON car.versionid=version.id
                    INNER JOIN image ON car.imageid=image.id
                    ORDER BY car.added DESC";

        $stmt = $this->db->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $c) {
            $equipment = Equipment::getForSpecificCar($c['car_id'], $this->db);

            array_push($cars, new Car($c['car_id'], $c['car_title'], new Make($c['make_id'], $c['make_name']), new Model($c['model_id'], $c['model_name']), new Version($c['version_id'], $c['version_name']), $c['car_manufactured'], new Color($c['color_id'], $c['color_name']), $equipment, new Image($c['image_id'], $c['image_filename'])));
        }

        return $cars;
    }
}