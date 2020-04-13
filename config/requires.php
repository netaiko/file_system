<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 12/04/2020
 * Time: 21:29
 */

require $_SERVER['DOCUMENT_ROOT'] . "/config/database.php";

require $_SERVER['DOCUMENT_ROOT'] . "/config/views.php";
require $_SERVER['DOCUMENT_ROOT'] . "/config/files.php";

require $_SERVER['DOCUMENT_ROOT'] . "/DataBaseConnection.php";

require $_SERVER['DOCUMENT_ROOT'] . "/Validators/FileValidator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Validators/FolderValidator.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Validators/TextFileValidator.php";

require $_SERVER['DOCUMENT_ROOT'] . "/Requests/IndexRequest.php";

require $_SERVER['DOCUMENT_ROOT'] . "/Models/Model.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Models/File.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Models/Folder.php";
require $_SERVER['DOCUMENT_ROOT'] . "/Controllers/IndexController.php";


require $_SERVER['DOCUMENT_ROOT'] . "/Views/View.php";

require $_SERVER['DOCUMENT_ROOT'] . "/Services/Loader.php";