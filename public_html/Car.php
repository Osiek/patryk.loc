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
        print_r($stmt->errorInfo());

        $addedCarId = $db->dbh->lastInsertId();

        $query = "INSERT INTO car_equipment (carid, equipmentid) VALUES (:carid, :equipmentid)";
        $stmt = $db->dbh->prepare($query);

        foreach ($this->equipment as $eq) {
            $stmt->bindValue(':carid', $addedCarId);
            $stmt->bindValue(':equipmentid', $eq->getId());
            $stmt->execute();
        }


    }
}