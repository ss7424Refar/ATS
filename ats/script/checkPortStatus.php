<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-15
 * Time: 上午9:35
 * use websocketd to server
 */

require_once '../ats_config.inc.php';
require_once '../function/atsDbConnect.php';

$detectFileName = ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix;

$pdoc = getPDOConnect();
$sql4GetSystem = "select * from ats_system_config where name = ?";
$sql4InsertSystem = "INSERT INTO `ats_system_config` (`name`, `value`) VALUES (?, unix_timestamp());";
$sql4UpdateSystem = "UPDATE `ats_system_config` SET `value`=unix_timestamp() WHERE `name`=?";
$sql4UpdateTask = "UPDATE `ats_testtask_info` SET `TestResult`=?, `TestResultPath`=?," .
    " `TestEndTime`=?, `TaskStatus`=? WHERE `TaskID`=?";

$jsonResult = array();

if (file_exists($detectFileName)) {
    $hasTime = false;
    $systemTime='';
    // db
    $stmt = $pdoc->prepare($sql4GetSystem);
    $stmt->execute(array('PrepareTimeStamp'));

    if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmt = $pdoc->prepare($sql4InsertSystem);
        $fileTime = exec('stat -c %Y '. $detectFileName);
        $stmt-> execute(array('PrepareTimeStamp'));
        if ($stmt -> rowCount() > 0) {
            $hasTime = true;
            $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' insert config in system_config';

        } else {
            $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' update config in system_config fail!';
        }
        $jsonResult['result'] = null;
        echo json_encode($jsonResult). "\n";
    } else {
        $hasTime = true;
    }

    while ($hasTime) {
        // 10 sec
        sleep(10);

        $fileTime = exec('stat -c %Y '. $detectFileName); //unix way
//        echo $fileTime. 'hhh'. time();
        $stmt = $pdoc->prepare($sql4GetSystem);
        $stmt->execute(array('PrepareTimeStamp'));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $systemTime = $row['value'];

        $file = fopen($detectFileName, 'r');

        $line = 0;
        $pushArray=array();
        while ($data = fgetcsv($file)) {
            $line++;
            if ($line >= 2){
                $tmpArray = array('id' => $data[0], 'machine' => $data[1], 'machineId'=> $data[2],
                    'LANIP'=>$data[3], 'ShelfId_SwitchId'=>$data[4]. '_'. $data[5]);
                array_push($pushArray, $tmpArray);

            }

        }
        fclose($file);
        $jsonResult['result'] = $pushArray;
        // mess
        if ($fileTime - $systemTime > 0) {
            $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' detect fileTimeStamp '. $fileTime . ' gt systemTimeStamp '. $systemTime;
            $stmt = $pdoc->prepare($sql4UpdateSystem);
            $stmt -> execute(array('PrepareTimeStamp'));
        } else if ($fileTime - $systemTime == 0) {
            $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' detect fileTimeStamp '. $fileTime . ' eq systemTimeStamp '. $systemTime;
            $stmt = $pdoc->prepare($sql4UpdateSystem);
            $stmt -> execute(array('PrepareTimeStamp'));
        } else {
            $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' detect no data update in TestPC';
        }

        echo json_encode($jsonResult) . "\n";

    }

} else {
    $jsonResult['message'] = date("Y-m-d H:i:s", time()) .' File Not Exist, disconnect';
    $jsonResult['result'] = null;
    echo json_encode($jsonResult) . "\n";
}

