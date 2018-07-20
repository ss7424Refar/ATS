<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/13/2018
 * Time: 9:05 AM
 */

require_once '../function/atsDbConnect.php';
require_once '../ats_config.inc.php';

$handler = opendir(ATS_FINISH_PATH);

$pdoc = getPDOConnect();
$sql4GetSystem = "select * from ats_system_config where name = ?";
$sql4InsertSystem = "INSERT INTO `ats_system_config` (`name`, `value`) VALUES (?, unix_timestamp());";
$sql4UpdateSystem = "UPDATE `ats_system_config` SET `value`=unix_timestamp() WHERE `name`=?";
$sql4UpdateTask = "UPDATE `ats_testtask_info` SET `TestResult`=?, `TestResultPath`=?," .
    " `TestEndTime`=?, `TaskStatus`=? WHERE `TaskID`=?";

$stmt = $pdoc->prepare($sql4GetSystem);
$stmt->execute(array('FinishTimeStamp'));
// update flag for system_db
$needUpdated = false;
// 10 sec
sleep(10);
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $saveTimeStamp = $row['value'];

    while (($filename = readdir($handler)) !== false) {
        //略过linux目录的名字为'.'和‘..'的文件
        if ($filename != "." && $filename != "..") {

            $fileTimeStamp = exec('stat -c %Y '. ATS_FINISH_PATH . $filename); // unix way
//            $fileTimeStamp = filectime(ATS_FINISH_PATH . $filename);
            if ($fileTimeStamp - $saveTimeStamp >= 0) {
                $file = fopen(ATS_FINISH_PATH . $filename, 'r');
                $tmpArray = array();

                while ($data = fgetcsv($file, 0, '=')) {

                    if ('TaskID' == $data[0]) {
                        $tmpArray['taskId'] = $data[1];
                    } else if ('TestResult' == $data[0]) {
                        $tmpArray['TestResult'] = $data[1];
                    } else if ('TestResultPath' == $data[0]) {
                        $tmpArray['TestResultPath'] = $data[1];
                    } else if ('TestEndTime' == $data[0]) {
                        $tmpArray['TestEndTime'] = $data[1];
                    } else if ('TaskStatus' == $data[0]) {
                        $tmpArray['TaskStatus'] = $data[1];
                    }

                }
                fclose($file);
                print_r($tmpArray);
                if (!empty($tmpArray)) {
                    $stmt = $pdoc->prepare($sql4UpdateTask);
                    $stmt->bindParam(1, $tmpArray['TestResult'], PDO::PARAM_STR);
                    $stmt->bindParam(2, $tmpArray['TestResultPath'], PDO::PARAM_STR);
                    $stmt->bindParam(3, $tmpArray['TestEndTime'], PDO::PARAM_STR);
                    $stmt->bindParam(4, $tmpArray['TaskStatus'], PDO::PARAM_STR);
                    $stmt->bindParam(5, $tmpArray['taskId'], PDO::PARAM_INT);

                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        if (!$needUpdated) {
                            $needUpdated = true;
                        }
                    }
                    echo date("Y-m-d H:i:s", time()) . ' : ' . $filename . ' [updated] taskDB result --> ' . $stmt->rowCount() . PHP_EOL;
                }

            }

        }

    }
    if ($needUpdated) {
        $stmt = $pdoc->prepare($sql4UpdateSystem);
        $stmt->execute(array('FinishTimeStamp'));
        echo date("Y-m-d H:i:s", time()) . ' : ' . '[updated] atsSystemConfig' . PHP_EOL;
    }

} else {
    $stmt = $pdoc->prepare($sql4InsertSystem);
    $stmt->execute(array('FinishTimeStamp'));
    echo date("Y-m-d H:i:s", time()) . ' : ' . '[insert] atsSystemConfig' . PHP_EOL;
}

//关闭连接
$pdoc = null;
