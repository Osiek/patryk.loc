<?php
set_include_path(
    get_include_path()
    .PATH_SEPARATOR."./configs/"
);
function __autoload($class_name) {
    //echo '<p>Ładuję klase: '.$class_name.'</p>';
    require_once $class_name . '.php';
}
?>