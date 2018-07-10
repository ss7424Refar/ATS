<?php
require_once '../config_db.inc.php';

function getDbConnect(){

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if (!$conn) {
        die('could not connect'. mysqli_connect_error());
    }
    mysqli_set_charset($conn, DB_CHARSET);

    return $conn;
}

function getPDOConnect(){
    $host = constant('DB_HOST');
    $user = constant('DB_USER');
    $pwd = constant('DB_PASS');
    $dbName = constant('DB_NAME');

    $dbh = 'mysql:host='. DB_HOST .';dbname='. DB_NAME;
    try {
        $pdoc = new PDO($dbh, $user, $pwd);
        return $pdoc;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }

}

getPDOConnect();