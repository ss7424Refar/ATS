<?php
require_once '../config_db.inc.php';

function getDbConnect(){
    $host = constant('DB_HOST');
    $user = constant('DB_USER');
    $pwd = constant('DB_PASS');
    $charset = constant('DB_CHARSET');
    $dbName = constant('DB_NAME');
    $port = constant('DB_PORT');

    $conn = mysqli_connect($host, $user, $pwd, $dbName, $port);

    if (!$conn) {
        die('could not connect'. mysqli_connect_error());
    }
    mysqli_set_charset($conn, $charset);

    return $conn;
}

function getPDOConnect(){
    $host = constant('DB_HOST');
    $user = constant('DB_USER');
    $pwd = constant('DB_PASS');
    $dbName = constant('DB_NAME');

    $dbh = 'mysql:host='. $host .';dbname='. $dbName;
    try {
        $pdoc = new PDO($dbh, $user, $pwd);
        return $pdoc;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }

}

getPDOConnect();