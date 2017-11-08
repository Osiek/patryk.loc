<?php
require_once 'autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {


$db = new Database();

$content = new Content($db);
$makes = $content->getObjects("make");
$models = $content->getObjects("model");
$versions = $content->getObjects("version");
$colors = $content->getObjects("color");
$equipments = $content->getObjects("equipment");

$car = Car::getCarWithId($_GET['id'], $db);

if(gettype($car) == 'boolean') die;

?>

<!doctype html>
<html lang="en">

<?php require_once 'html/head.html'; ?>

<body>

<?php require_once 'html/navbar.html'; ?>

<div class="container">
    <h1>Dodaj samochód</h1>
    <form enctype="multipart/form-data" action="edit_post.php" method="post">
        <div class="form-group">
            <label for="car_title">Nazwa wpisu:</label>
            <input name="car_title" type="text" class="form-control" id="car_title" value="<?php echo $car->title ?>">
        </div>
        <div class="form-group">
            <label for="make_name">Marka</label>
            <select name="make_name" class="form-control" id="make_name">
                <?php foreach ($makes as $m) {
                    if ($m->getId() == $car->make->getId()) echo '<option selected value="'.$m->getId().'">'.$m->getName().'</option>';
                    else echo '<option value="'.$m->getId().'">'.$m->getName().'</option>';

                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="model_name">Model</label>
            <select name="model_name" class="form-control" id="model_name">
                <?php foreach ($models as $m) {
                    if ($m->getId() == $car->model->getId()) echo '<option selected value="'.$m->getId().'">'.$m->getName().'</option>';
                    else echo '<option value="'.$m->getId().'">'.$m->getName().'</option>';

                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="version_name">Wersja</label>
            <select name="version_name" class="form-control" id="version_name">
                <?php foreach ($versions as $m) {
                    if ($m->getId() == $car->version->getId()) echo '<option selected value="'.$m->getId().'">'.$m->getName().'</option>';
                    else echo '<option value="'.$m->getId().'">'.$m->getName().'</option>';

                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="car_manufactured">Rok produkcji</label>
            <input name="car_manufactured" type="text" class="form-control" id="car_manufactured" value="<?php echo $car->manufactured; ?>">
        </div>
        <div class="form-group">
            <label for="color_name">Kolor</label>
            <select name="color_name" class="form-control">
                <?php foreach ($colors as $m) {
                    if ($m->getId() == $car->color->getId()) echo '<option selected value="'.$m->getId().'">'.$m->getName().'</option>';
                    else echo '<option value="'.$m->getId().'">'.$m->getName().'</option>';

                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="equipment_name">Wyposażenie</label>

              <span class="input-group-addon">
                  <?php foreach ($equipments as $m) {
                      $tmp = false;
                      foreach ($car->equipment as $e) {
                          if($m->getId() == $e->getId()) {
                              $tmp = true;
                              echo '<label><input checked name="equipmentname[]" type="checkbox" value="'.$m->getId().'">'.$m->getName().'</label>';
                              break;
                          }

                      }
                      if($tmp == false) {
                          echo '<label><input name="equipmentname[]" type="checkbox" value="'.$m->getId().'">'.$m->getName().'</label>';
                      }
//                  echo '<label><input name="equipmentname[]" type="checkbox" value="'.$m->getId().'">'.$m->getName().'</label>';

                  }?>
              </span>

        </div>
        <div class="form-group">
            <input name="car_id" type="hidden" class="form-control" id="car_id" value="<?php echo $car->id ?>">
            <input name="image_id" type="hidden" class="form-control" id="image_id" value="<?php echo $car->image->getId() ?>">
        </div>
        <button type="submit" class="btn btn-default">Zapisz zmiany</button>
    </form>
</div>
</body>
</html>
<?php

} else {
die;
}

?>