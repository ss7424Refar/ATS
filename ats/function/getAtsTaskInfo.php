<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-24
 * Time: 上午8:06
 */

$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
$pageNo = isset($_GET['pageNumber']) ? $_GET['pageNumber'] : 1;
$taskIdSingle = isset($_GET['taskId']) ? $_GET['taskId'] : '';
$offset = ($pageNo-1)*$pageSize;

//$pageSize = 10;
//$pageNo = 2;
// ------------------DB connect ----------------------
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

// ------------------DB connect ----------------------

// ------------------get_ats_testtask_info_Count & Info-------

$tableHeader = "TaskID, TestMachine, TestImage, MachineID, ".
    "TestItem,  TaskStatus, TestStartTime, TestEndTime, TestResult,".
    "TestResultPath";

if (!empty($taskIdSingle)) {
    $taskIdSingle = trim($taskIdSingle);
    $sqlCount = "select count(*) from ats_testtask_info where TaskID = $taskIdSingle";
    $sqlDetail = "select $tableHeader from ats_testtask_info where TaskID = $taskIdSingle";

} else {
    $sqlCount = "select count(*) from ats_testtask_info";
    $sqlDetail = "select $tableHeader from ats_testtask_info where  TaskID >= (select TaskID from ats_testtask_info order by TaskID limit $offset, 1) limit $pageSize ";
}
$resultCount = mysqli_query($conn,$sqlCount);
$total = mysqli_fetch_array($resultCount)[0];

// echo $sqlDetail;

$rowsResult = array();
$resultDetail = mysqli_query($conn,$sqlDetail);
while($row = $resultDetail->fetch_assoc()){
    array_push($rowsResult, $row);
}

$jsonResult['total'] = $total;
$jsonResult['rows'] = $rowsResult;

// ------------------get_ats_testtask_info_Count  & Info -------

echo json_encode($jsonResult);

$conn->close();