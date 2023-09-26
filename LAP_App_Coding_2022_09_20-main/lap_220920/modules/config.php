<?php
    require_once('../classes/database.php');

    // define database credencials
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'lap_220920');

    // create new Database
    $database = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    //senha Q^jtvXrRTbah)8FN usuario lapuser
?>