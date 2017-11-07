<?php
require_once 'autoload.php';
/**
 * Created by PhpStorm.
 * User: patry
 * Date: 2017-11-07
 * Time: 23:23
 */

if($_GET !== null) {
    if(!is_numeric($_GET['id'])) return;
    $db = new Database();
    $stmt =  $db->dbh->prepare("DELETE FROM car WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
} elseif (count($_POST['carstodelete']) > 0) {
    $db = new Database();
    $stmt =  $db->dbh->prepare("DELETE FROM car WHERE id = :id");
    foreach ($_POST['carstodelete'] as $id) {
        if(is_numeric($id)) {
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
    }
}

header("Location: admin.php");
die();