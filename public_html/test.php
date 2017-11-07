<?php
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 09:54
 */

require_once 'autoload.php';

$db = new Database();
$content = new Content($db);
$content->getAllCars();