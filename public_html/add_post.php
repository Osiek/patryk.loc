<?php
require_once 'autoload.php';

if(!empty($_POST)) {
    $validate = true;
    foreach ($_POST as $r) {
        if(preg_match('/[a-Z0-9\s]+/', trim($r)) == 0) {
            $validate = false;
            echo $r;
            break;
        }
    }

    if($validate) {

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



        $image = Image::fileUpload($image, $_SERVER['DOCUMENT_ROOT'] . "/images/uploaded/", $db);

        $car = new Car(null, $car_title, $make, $model, $version, $car_manufactured, $color, $equipments, $image);
        $car->save($db);
    }
}

//header("Location: index.php");
die();