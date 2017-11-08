<?php
require_once 'autoload.php';

class Car
{
    public $id;
    public $title;
    public $make;
    public $model;
    public $version;
    public $manufactured;
    public $color;
    public $equipment = array();
    public $image;

    public function __construct($id, $title, Make $make, Model $model, Version $version, $manufactured, Color $color, array $equipment, Image $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->make = $make;
        $this->model = $model;
        $this->version = $version;
        $this->manufactured = $manufactured;
        $this->color = $color;
        $this->equipment = $equipment;
        $this->image = $image;
    }

    public function save(Database $db) {
        $query = "INSERT INTO car (title, added, manufactured, makeid, modelid, versionid, colorid, imageid) 
                  VALUES(:title, :added, :manufactured, :makeid, :modelid, :versionid, :colorid, :imageid)";
        $stmt = $db->dbh->prepare($query);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':added', date('Y-m-d G:i:s'));
        $stmt->bindParam(':manufactured', $this->manufactured);
        $stmt->bindParam(':makeid', $this->make->getId());
        $stmt->bindParam(':modelid', $this->model->getId());
        $stmt->bindParam(':versionid', $this->version->getId());
        $stmt->bindParam(':colorid', $this->color->getId());
        $stmt->bindParam(':imageid', $this->image->getId());
        $stmt->execute();

        $addedCarId = $db->dbh->lastInsertId();

        $query = "INSERT INTO car_equipment (carid, equipmentid) VALUES (:carid, :equipmentid)";
        $stmt = $db->dbh->prepare($query);

        foreach ($this->equipment as $eq) {
            $stmt->bindValue(':carid', $addedCarId);
            $stmt->bindValue(':equipmentid', $eq->getId());
            $stmt->execute();
        }

    }

    public function update(Database $db) {
        $query = "UPDATE car 
                  SET title = :title, 
                  added = :added, 
                  manufactured = :manufactured, 
                  makeid = :makeid, 
                  modelid = :modelid, 
                  versionid = :versionid, 
                  colorid = :colorid, 
                  imageid = :imageid 
                  WHERE id = :id";
        $stmt = $db->dbh->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':added', date('Y-m-d G:i:s'));
        $stmt->bindParam(':manufactured', $this->manufactured);
        $stmt->bindParam(':makeid', $this->make->getId());
        $stmt->bindParam(':modelid', $this->model->getId());
        $stmt->bindParam(':versionid', $this->version->getId());
        $stmt->bindParam(':colorid', $this->color->getId());
        $stmt->bindParam(':imageid', $this->image->getId());
        $stmt->execute();

        $addedCarId = $db->dbh->lastInsertId();

        $query = "DELETE FROM car_equipment 
                  WHERE carid = :carid";
        $stmt = $db->dbh->prepare($query);

        $stmt->bindValue('carid', $this->id);
        $stmt->execute();

        $query = "INSERT INTO car_equipment (carid, equipmentid) VALUES (:carid, :equipmentid)";
        $stmt = $db->dbh->prepare($query);

        foreach ($this->equipment as $eq) {
            $stmt->bindValue(':carid', $this->id);
            $stmt->bindValue(':equipmentid', $eq->getId());
            $stmt->execute();
        }

    }

    public static function getCarWithId($id, Database $db)
    {
        $car = 0;
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
                    WHERE car.id = :car_id
                    LIMIT 1";

        $stmt = $db->dbh->prepare($query);

        $stmt->bindParam(':car_id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $c) {
            $equipment = Equipment::getForSpecificCar($c['car_id'], $db);

            $car = new Car($c['car_id'], $c['car_title'], new Make($c['make_id'], $c['make_name']), new Model($c['model_id'], $c['model_name']), new Version($c['version_id'], $c['version_name']), $c['car_manufactured'], new Color($c['color_id'], $c['color_name']), $equipment, new Image($c['image_id'], $c['image_filename']));
        }

        if(gettype($car) == 'object') return $car;
        return false;
    }
}