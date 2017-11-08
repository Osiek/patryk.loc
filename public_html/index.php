<?php
require_once 'autoload.php';

$db = new Database();
$content = new Content($db);
$myCars = $content->getAllCars();

?>
<!doctype html>
<html lang="en">
<?php require_once 'html/head.html'; ?>
<body>
<?php require_once 'html/navbar.html'; ?>
<div class="container">
    <h1>Samochody</h1>
    <?php
    if(count($myCars) == 0) echo '<h2>Brak samochodów do wyświetlnia</h2>';
    foreach ($myCars as $c) {
        ?>
        <div class="row">
            <h2><?php echo $c->title; ?></h2>
            <div class="col-lg-4"><img src="images/uploaded/<?php echo $c->image->getFileName(); ?>" class="img-thumbnail"/></div>
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
                        <td><?php echo $c->make->getName();
                            ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><?php echo $c->model->getName();
                            ?></td>
                    </tr>
                    <tr>
                        <td>Wersja</td>
                        <td><?php echo $c->version->getName();
                            ?></td>
                    </tr>
                    <tr>
                        <td>Rok produkcji</td>
                        <td><?php echo $c->manufactured;
                            ?></td>
                    </tr>
                    <tr>
                        <td>Kolor</td>
                        <td><?php echo $c->color->getName();
                            ?></td>
                    </tr>
                    <tr>
                        <td>Wyposażenie</td>
                        <td>
                            <ul class="list-group">
                                <?php foreach ($c->equipment as $acc) {echo '<li class="list-group-item">'.$acc->getName().'</li>'; }
                                ?>
                            </ul>
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