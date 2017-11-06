<?php
require_once 'autoload.php';

class Car
{
    public $id;
    public $title;
    public $make;
    public $model;
    public $version = array();
    public $manufactured;
    public $color;
    public $equipment = array();
    public $image;

    public function __construct($id, $title, $make, $model, $version, $manufactured, $color, $equipment, $image)
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

    public function save() {
        $db = new Database();

    }
}