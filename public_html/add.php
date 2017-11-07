<?php
require_once 'autoload.php';

$db = new Database();

$content = new Content($db);
$makes = $content->getObjects("make");
$colors = $content->getObjects("color");
$equipments = $content->getObjects("equipment");

?>

<!doctype html>
<html lang="en">

<?php require_once 'html/head.html'; ?>

<body>

<?php require_once 'html/navbar.html'; ?>

<div class="container">
    <h1>Dodaj samochód</h1>
    <form enctype="multipart/form-data" action="add_post.php" method="post">
        <div class="form-group">
            <label for="car_title">Nazwa wpisu:</label>
            <input name="car_title" type="text" class="form-control" id="car_title">
        </div>
        <div class="form-group">
            <label for="make_name">Marka</label>
            <select name="make_name" class="form-control" id="make_name">
                <?php foreach ($makes as $m) { ?>
                <option value="<?php echo $m->getId(); ?>"><?php echo $m->getName(); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="model_name">Model</label>
            <select name="model_name" class="form-control" id="model_name">

            </select>
        </div>
        <div class="form-group">
            <label for="version_name">Wersja</label>
            <select name="version_name" class="form-control" id="version_name">

            </select>
        </div>
        <div class="form-group">
            <label for="car_manufactured">Rok produkcji</label>
            <input name="car_manufactured" type="text" class="form-control" id="car_manufactured">
        </div>
        <div class="form-group">
            <label for="color_name">Kolor</label>
            <select name="color_name" class="form-control">
                <?php foreach ($colors as $m) { ?>
                    <option value="<?php echo $m->getId(); ?>"><?php echo $m->getName(); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="equipment_name">Wyposażenie</label>

              <span class="input-group-addon">
                  <?php foreach ($equipments as $m) { ?>
                      <label><input name="equipmentname[]" type="checkbox" value="<?php echo $m->getId(); ?>"><?php echo $m->getName(); ?></label>
                  <?php } ?>

              </span>

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