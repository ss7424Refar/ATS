<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:44
 */

require_once 'atsTestTask.class.php';
$action=isset($_GET['do']) ? isset($_GET['do']) : '';

// handler
if(!empty($action)){
    // $atsTaskInfo
    $atsTask = new atsTestTask;
    switch ($action){
        case 'checkTaskId':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTask->checkTaskIdExist($taskID);
        case 'addTask':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTask->checkTaskIdExist($taskID);



        default:
    }


}