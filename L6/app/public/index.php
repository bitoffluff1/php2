<?php

//use \App\services\renders\TmplRender;
use \App\services\renders\TwigRender;

session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/../../vendor/autoload.php');

$request = new \App\services\Request();
$controllerName = $request->getControllerName() ?: "user";
$actionName = $request->getActionName();

$controllerName = "App\\controllers\\" . ucfirst($controllerName) . "Controller";

if (class_exists($controllerName)) {
    $controller = new $controllerName(new TwigRender(), $request);
    $controller->run($actionName);
} else {
    $controllerName = "App\controllers\UserController";
    $controller = new $controllerName(new TwigRender(), $request);
    $controller->run("error");
}
