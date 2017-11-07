<?php
require_once 'autoload.php';

if(!empty($_POST)) {
    $db = new Database();
    $car_title = $_POST['car_title'];
    $car_manufactured = $_POST['car_manufactured'];
    $make_name = $_POST['make_name'];
    $model_name = $_POST['model_name'];
    $version_name = $_POST['version_name'];
    $color_name = $_POST['color_name'];
    $equipment_names = $_POST['equipmentname'];
    $image = $_FILES;

    $make = Make::withId($make_name, $db);
    $model = Model::withId($model_name, $db);
    $version = Version::withId($version_name, $db);
    $color = Color::withId($color_name, $db);
    $equipments = array();

    foreach ($equipment_names as $eq) {
        array_push($equipments, Equipment::withId($eq, $db));
    }

    echo '<pre>';
//    print_r($_POST);
//    print_r($_FILES);
//    print_r($equipment_names);
//
//    print_r($make);
//    print_r($model);
//    print_r($version);
//    print_r($color);
//    print_r($equipments);
//    print_r($car_manufactured);
//    print_r($car_title);
    print_r($image);
    echo '</pre>';

    $image = Image::fileUpload($image, $_SERVER['DOCUMENT_ROOT']."/images/uploaded/", $db);

    $car = new Car(null, $car_title, $make, $model, $version, $car_manufactured, $color, $equipments, $image);
    $car->save($db);

}