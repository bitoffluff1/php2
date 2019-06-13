<?php
include ($_SERVER["DOCUMENT_ROOT"] . "/../services/Autoload.php");

use App\services\Db;
use App\services\Autoload;
use App\models\Good;

spl_autoload_register([new Autoload(), "loadClass"]);

$good = new Good(new Db());

var_dump($good -> getCount([1, 4, 7]));