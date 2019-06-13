<?php
include($_SERVER["DOCUMENT_ROOT"] . "/../services/Autoload.php");

use App\services\Db;
use App\services\Autoload;
use App\models\Good;

spl_autoload_register([new Autoload(), "loadClass"]);

$good = new Good();
//$good2 = new Good();

//var_dump($good->getOne(3));
//var_dump($good->getAll());

$good->address = "img/product-like4.jpg";
$good->name = "Mango People T-shirt";
$good->price = 100;
$good->update(26);

//$good->delete(26);


//var_dump((new Db())->query(
//    "SELECT * FROM users"
//)->fetchAll());

//var_dump($good -> getCount([1, 4, 7]));