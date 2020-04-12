<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 21:22
 */


define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_DATABASE', 'test');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');


define('DB_TABLES', [
    'Models\File' => 'files',
    'Models\Folder' => 'folders',
]);