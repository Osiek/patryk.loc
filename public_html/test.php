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
$make1 = Make::withId(1, $db);
$make2 = Make::withId('ka', $db);
echo '<pre>';
echo is_object($make1);
print_r(is_object($make2));
echo '</pre>';