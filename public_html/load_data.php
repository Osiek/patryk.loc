<?php
require_once 'autoload.php';
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 12:13
 */
header('Content-Type: application/json');


$db = new Database();
$content = new Content($db);
$jsonString = array();

if($_GET['type'] == "model") {
    $models = $content->getObjects("model", $_GET['parentid']);

    foreach ($models as $k => $m) {
        $newData = array(
            'id' => $m->getId(),
            'name' => $m->getName()
        );
        array_push($jsonString, $newData);
    }

    $jsonString = json_encode($jsonString);
    echo $jsonString;

} elseif ($_GET['type'] == "version") {
    $versions = $content->getObjects("version", $_GET['parentid']);

    foreach ($versions as $k => $m) {
        $newData = array(
            'id' => $m->getId(),
            'name' => $m->getName()
        );
        array_push($jsonString, $newData);
    }

    $jsonString = json_encode($jsonString);
    echo $jsonString;

}