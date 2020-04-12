<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 09/04/2020
 * Time: 10:39
 */

require "./config/database.php";
require "./config/views.php";
require "./config/files.php";

require "DataBaseConnection.php";

require "./Validators/FileValidator.php";
require "./Validators/FolderValidator.php";
require "./Validators/TextFileValidator.php";

require "./Requests/IndexRequest.php";

require "./Models/Model.php";
require "./Models/File.php";
require "./Models/Folder.php";
require "./Controllers/IndexController.php";


require "./Views/View.php";

require "./Services/Loader.php";


use controllers\IndexController;
use services\Loader;

Loader::run();


$search = empty($_GET['search']) ? null : $_GET['search'];



$controller = new IndexController();


$controller->index($search);





