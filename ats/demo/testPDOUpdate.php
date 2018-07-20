<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-14
 * Time: 上午9:39
 */

require_once '../function/atsDbConnect.php';

$pdoc = getPDOConnect();
$sql4UpdateTask = "UPDATE `ats_testtask_info` SET `TestResult`=?, `TestResultPath`=?," .
    " `TestEndTime`=?, `TaskStatus`=? WHERE `TaskID`=?";



$tmpArray = array('taskId' => 12, 'TestResult' => 'pass', 'TestResultPath' => '//192','TestEndTime' => '2018-08-13 21:59:06',
    'TaskStatus'=> '1');

if (!empty($tmpArray)) {
    $stmt1 = $pdoc->prepare($sql4UpdateTask);
    $stmt1->bindValue(1, $tmpArray['TestResult'], PDO::PARAM_STR);
    $stmt1->bindValue(2, $tmpArray['TestResultPath'], PDO::PARAM_STR);
    $stmt1->bindValue(3, $tmpArray['TestEndTime'], PDO::PARAM_STR);
    $stmt1->bindValue(4, $tmpArray['TaskStatus'], PDO::PARAM_STR);
    $stmt1->bindValue(5, $tmpArray['taskId'], PDO::PARAM_INT);

    $stmt1->execute();

    if ($stmt1->rowCount() > 0) {
     echo 'hh';
    }
}