<?php
require_once 'autoload.php';

$db = new Database();

$content = new Content($db);
$cars = $content->getAllCars();

?>

<!doctype html>
<html lang="en">

<?php require_once 'html/head.html'; ?>

<body>

<?php require_once 'html/navbar.html'; ?>

<div class="container">
    <h1>Zarządzanie zawartością</h1>
    <form enctype="multipart/form-data" action="delete.php" method="post">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>ID</th>
                    <th>Akcja</th>
                    <th>Zaznacz</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($cars as $c) {
            ?>
                <tr>
                    <td><?php echo $c->title; ?></td>
                    <td><?php echo $c->id ?></td>
                    <td><a href="edit.php?id=<?php echo $c->id ?>">Edytuj</a> <a href="delete.php?id=<?php echo $c->id ?>">Usuń</a></td>
                    <td><input type="checkbox" name="carstodelete[]" value="<?php echo $c->id ?>"/></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <input type="submit" value="Usuń" />
    </form>
</div>
</body>
</html>