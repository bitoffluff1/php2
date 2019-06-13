<?php

use App\services\Db;
use App\services\Autoload;
use App\models\Good;
use \App\services\renders\TmplRender;
use \App\services\renders\TwigRender;

require_once($_SERVER['DOCUMENT_ROOT'] . '/../../vendor/autoload.php');
//include($_SERVER["DOCUMENT_ROOT"] . "/../services/Autoload.php");
//spl_autoload_register([new Autoload(), "loadClass"]);


//$loader = new Twig_Loader_String();
//$twig = new Twig_Environment($loader);
//
//echo $twig->render('Hello {{ name }}!', array('name' => 'Fabien'));



$controllerName = $_GET["c"] ?: "user";
$actionName = $_GET["a"];

$controllerName = "App\\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerName)) {
    $controller = new $controllerName(new TmplRender());
    $controller->run($actionName);
}


//var_dump(Good::getOne(2));
//$good = new Good();

//$good->getOne(29)->delete();

//$good->address = "img/product-like4.jpg";
//$good->name = "Mango People T-shirt";
//$good->price = 100;
//$good->id = 29;
//$good->save();

//var_dump((new Db())->query(
//    "SELECT * FROM users"
//)->fetchAll());

//var_dump($good -> getCount([1, 4, 7]));