<?php
require_once 'autoload.php';
/**
 * Created by PhpStorm.
 * User: prubaj
 * Date: 07.11.17
 * Time: 12:13
 */

$db = new Database();
$content = new Content($db);

if($_GET['type'] == "model") {
    $models = $content->getObjects("model", $_GET['parentid']);

    foreach ($models as $m) { ?>
        <option value="<?php echo $m->getId(); ?>"><?php echo $m->getName(); ?></option>
        <?php
    }
} elseif ($_GET['type'] == "version") {
    $versions = $content->getObjects("version", $_GET['parentid']);

    foreach ($versions as $v) { ?>
        <option value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
        <?php
    }
}