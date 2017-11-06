<?php
require_once 'autoload.php';
//$id, $title, $make, $model, $version, $manufactured, $color, $equipment, $image
?>

<!doctype html>
<html lang="en">

<?php require_once 'html/head.html'; ?>

<body>

<?php require_once 'html/navbar.html'; ?>

<div class="container">
    <h1>Dodaj samochód</h1>
    <form action="add_post.php" method="post">
        <div class="form-group">
            <label for="car_title">Nazwa wpisu:</label>
            <input name="car_title" type="text" class="form-control" id="car_title">
        </div>
        <div class="form-group">
            <label for="make_name">Marka</label>
            <input name="make_name" type="text" class="form-control" id="make_name">
        </div>
        <div class="form-group">
            <label for="model_name">Model</label>
            <input name="model_name" type="text" class="form-control" id="model_name">
        </div>
        <div class="form-group">
            <label for="version_name">Wersja</label>
            <input name="version_name" type="text" class="form-control" id="version_name">
        </div>
        <div class="form-group">
            <label for="car_manufactured">Rok produkcji</label>
            <input name="car_manufactured" type="text" class="form-control" id="car_manufactured">
        </div>
        <div class="form-group">
            <label for="color_name">Kolor</label>
            <input name="color_name" type="text" class="form-control" id="color_name">
        </div>
        <div class="form-group">
            <label for="equipment_name">Wyposażenie</label>
            <textarea name="equipment_name" type="text" class="form-control" id="equipment_name"></textarea>
        </div>
        <div class="form-group">
            <label for="image_path">Zdjęcie</label>
            <input name="image_path" type="file" class="form-control" id="image_path"></input>
        </div>
        <button type="submit" class="btn btn-default">Dodaj samochód</button>
    </form>
</div>
</body>
</html>