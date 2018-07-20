<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-24
 * Time: 上午8:06
 */

$pageSize = $_GET['limit'];
$pageNo = $_GET['offset'];
$offset = ($pageNo-1)*$pageSize;

//$pageSize = 10;
//$pageNo = 2;

$host = "localhost";
$username = "root";
$password = "123456";
$database = "tpms";
$port = "3306";

$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die('could not connect'. mysqli_connect_error());
}
mysqli_set_charset($conn,"utf8");

$sql = "select count(*) from ats_testtask_info";
$result = mysqli_query($conn,$sql);
$total = mysqli_fetch_array($result)[0];


$sql = "select TaskID, TestMachine, TestImage, DMI_SerialNumer, ".
    "TestItem,  TaskStatus, TestStartTime, TestEndTime, TestResult,".
    "TestResultPath from ats_testtask_info where  TaskID >= (select TaskID from ats_testtask_info order by TaskID limit $offset, 1) limit $pageSize ";
$result = mysqli_query($conn,$sql);

$jsonResult = array();
while($row = $result->fetch_assoc()){
    array_push($jsonResult, $row);
}

$result2['total'] = $total;
$result2['rows'] = $jsonResult;

echo json_encode($result2);

$conn->close();