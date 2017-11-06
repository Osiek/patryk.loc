<?php
require_once 'autoload.php';


$myCars = array();
$query = "  SELECT car.id, car.title, car.manufactured, color.name, make.name, model.name, version.name, image.path
            FROM car 
            INNER JOIN color ON car.colorid=color.id
            INNER JOIN make ON car.makeid=make.id
            INNER JOIN model ON car.modelid=model.id
            INNER JOIN version ON car.versionid=version.id
            INNER JOIN image ON car.imageid=image.id";

    $db = new Database();
    $db->checkIfExists('color', 'name', 'czerwony');
    $stmt = $db->dbh->prepare($query);
    $stmt->execute();
    $cars = $stmt->fetchAll();

foreach ($cars as $car) {
    $equipment = $db->dbh->prepare("SELECT equipment.name
        FROM equipment
        INNER JOIN car_equipment ON car_equipment.equipmentid=equipment.id
        WHERE car_equipment.carid = :carId");
    $equipment->bindParam(':carId', $car[0]);
    $equipment->execute();
    $accesories = $equipment->fetchAll();

    $car = new Car($car[0], $car[1], $car[4], $car[5], $car[6], $car[2], $car[3], $accesories, $car[7]);
    array_push($myCars, $car);
}


?>
<!doctype html>
<html lang="en">
<?php require_once 'html/head.html'; ?>
<body>
<?php require_once 'html/navbar.html'; ?>
<div class="container">
    <h1>Samochody</h1>
    <?php
    foreach ($myCars as $c) {
        ?>
        <div class="row">
            <h2><?php echo $c->title; ?></h2>
            <div class="col-lg-4"><img src="images/uploaded/<?php echo $c->image; ?>" width="140px" height="60px"/></div>
            <div class="col-lg-8">
                <h2></h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nazwa:</th>
                        <th>Wartość:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Marka</td>
                        <td><?php echo $c->make;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?php echo $c->model;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Wersja</td>
                        <td><?php echo $c->version;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Rok produkcji</td>
                        <td><?php echo $c->manufactured;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Kolor</td>
                        <td><?php echo $c->color;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Wyposażenie</td>
                        <td>
                            <?php foreach ($c->equipment as $acc) {echo $acc[0].' '; }
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }
    ?>
</div>

</body>
</html>