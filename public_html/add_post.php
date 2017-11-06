<?php
if(!empty($_POST)) {
$car = new Car(
            NUll,
            $_POST['car_title'],
            $_POST['make_name'],
            $_POST['model_name'],
            $_POST['version_name'],
            $_POST['car_manufactured'],
            $_POST['color_name'],
            $_POST['equipment_name'],
            "img1.jpg");


}