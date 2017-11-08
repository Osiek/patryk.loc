<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'autoload.php';

$formErrors = array();
$db = new Database();

if(!empty($_POST)) {
    $valid = true;
    foreach ($_POST as $key => $r) {
        if(!$key == "equipmentname") {
            if (preg_match('/[a-zA-Z0-9\s\,]+/', trim($r)) == 0) {
                array_push($formErrors, "Element " . $key . " zawiera błąd.");
                $valid = false;
            }
        }
    }

    if(!(is_numeric($_POST['car_manufactured']) && $_POST['car_manufactured'] < date('Y')+1 && $_POST['car_manufactured'] > 1970)) {
        $valid = false;
        array_push($formErrors, "Element car_manufactured zawiera błąd.");
    }

    if($image === false) {
        $valid = false;
        array_push($formErrors, "Niepoprawne zdjęcie.");
    }

    if($valid) {
        $car_id = $_POST['car_id'];
        $car_title = $_POST['car_title'];
        $car_manufactured = $_POST['car_manufactured'];
        $make_name = $_POST['make_name'];
        $model_name = $_POST['model_name'];
        $version_name = $_POST['version_name'];
        $color_name = $_POST['color_name'];
        $image_id = $_POST['image_id'];

        $equipment_names = array();
        if(isset($_POST['equipmentname'])) {
            $equipment_names = $_POST['equipmentname'];
        }

        $make = Make::withId($make_name, $db);
        $model = Model::withId($model_name, $db);
        $version = Version::withId($version_name, $db);
        $color = Color::withId($color_name, $db);
        $image = Image::fromId($image_id, $db);
        $equipments = array();

        foreach ($equipment_names as $eq) {
            array_push($equipments, Equipment::withId($eq, $db));
        }

        if($make->getId() <= 0 || $model->getId() <= 0 || $version->getId() <= 0 || $color->getId() <= 0) {
            array_push($formErrors, "Wybierz istniejące wartości w formularzu.");

        } else {
            //$image = Image::fileUpload($image, $_SERVER['DOCUMENT_ROOT'] . "/images/uploaded/", $db);

            $car = new Car($car_id, $car_title, $make, $model, $version, $car_manufactured, $color, $equipments, $image);
            $car->update($db);
            echo '<p>Zapisano | Idź do <a href="index.php">strony głównej</a></p>';
        }

    }

    if(count($formErrors) > 0) {
        echo '<p>Wystąpił błąd | Idź do <a href="index.php">strony głównej</a> lub edutuj ponownie<a href="edit.php?id='.$_POST['car_id'].'"> formularz</a></p>';
        foreach ($formErrors as $err) {
            echo '<p>' . $err . '</p>';
        }
    }
}