<?php
require_once 'autoload.php';
/**
 * Created by PhpStorm.
 * User: patry
 * Date: 2017-11-07
 * Time: 23:23
 */

$db = new Database();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(!is_numeric($_GET['id'])) return;

    $stmt =  $db->dbh->prepare("DELETE FROM car 
                                         WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);

    $stmt->execute();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && count($_POST['carstodelete']) > 0) {
    $stmt =  $db->dbh->prepare("DELETE FROM car 
                                         WHERE id = :id");

    foreach ($_POST['carstodelete'] as $id) {
        if(is_numeric($id)) {
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        }
    }
}

header("Location: admin.php");
die();