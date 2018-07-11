<?php
require_once '../ats_config.inc.php';

function getDbConnect(){

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

    if (!$conn) {
        die('could not connect'. mysqli_connect_error());
    }
    mysqli_set_charset($conn, DB_CHARSET);

    return $conn;
}

function getPDOConnect(){

    $dbh = 'mysql:host='. DB_HOST .';dbname='. DB_NAME;
//    echo $dbh;
    try {
        $pdoc = new PDO($dbh, DB_USER, DB_PASS);
        return $pdoc;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}
