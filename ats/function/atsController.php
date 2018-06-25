<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:44
 */

require_once 'atsTestTaskInfo.class.php';
$action=isset($_GET['do']) ? isset($_GET['do']) : '';

// handler
if(!empty($action)){
    // $atsTaskInfo
    $atsTaskInfo = new atsTestTaskInfo;
    switch ($action){
        case 'checkTaskId':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTaskInfo->checkTaskIdExist($taskID);

        default:
    }


}