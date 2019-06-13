<?php

use App\services\Db;
use App\services\Autoload;
use App\models\Good;

include($_SERVER["DOCUMENT_ROOT"] . "/../services/Autoload.php");
spl_autoload_register([new Autoload(), "loadClass"]);

$controllerName = $_GET["c"] ?: "user";
$actionName = $_GET["a"];

$controllerName = "App\\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    $controller->run($actionName);
}

//var_dump(Good::getOne(2));
$good = new Good();

//$good->getOne(26)->delete();

//$good->address = "img/product-like4.jpg";
//$good->name = "Mango People T-shirt";
//$good->price = 50;
//$good->id = 29;
//$good->save();

//var_dump((new Db())->query(
//    "SELECT * FROM users"
//)->fetchAll());

//var_dump($good -> getCount([1, 4, 7]));