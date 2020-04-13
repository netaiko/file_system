<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 10:39
 */

require __DIR__ . "/config/requires.php";


use controllers\IndexController;
use services\Loader;

$loader = new Loader();
$loader->run();


$search = empty($_GET['search']) ? null : $_GET['search'];


$controller = new IndexController();


$controller->index($search);





