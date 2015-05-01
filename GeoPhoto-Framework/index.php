<?php
require_once('includes/config.php');

echo "I am index PHP";
echo "<br/>";
$requestParts = explode('/',$_SERVER['REQUEST_URI']);

$controller = DEFAULT_CONTROLLER;
if(count($requestParts)>=2 && $requestParts[1] != ''){
    $controller = $requestParts[1];
}

$action = DEFAULT_ACTION;
if(count($requestParts)>=3 && $requestParts[2] != ''){
    $action = $requestParts[2];
}

function __autoload($class_name){
    if(file_exists("controllers/$class_name.php")){
        include "controllers/$class_name.php";
    }
    if(file_exists("models/$class_name.php")){
        include "models/$class_name.php";
    }
}
?>
