<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:44
 */

require_once 'atsTestTask.class.php';
$action=isset($_GET['do']) ? $_GET['do'] : '';

// handler
if(!empty($action)){
    // $atsTaskInfo
    $atsTask = new atsTestTask;

    switch ($action){
        case 'getAtsInfoByTaskId':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTask->getAtsTaskInfoByTaskId($taskID);
            break;
        case 'getAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->getAtsTaskInfoByTaskId($multiTask);
            break;
        case 'addTask':
            $atsTask->insertAtsTaskInfo(process4InitAddTaskForm());
            break;
        default:

    }

}

function process4InitAddTaskForm(){

    $testMachine=isset($_GET['testMachine']) ? $_GET['testMachine'] : '';
    if(!empty($testMachine)){
        $testMachine = substr($testMachine, 0, stripos($testMachine, "("));
    }

    $machineId=isset($_GET['machineId']) ? $_GET['machineId'] : '';
    $testItem=isset($_GET['testItem']) ? $_GET['testItem'] : '';
    $testImage=isset($_GET['testImage']) ? $_GET['testImage'] : '';
    $customer=isset($_GET['customer']) ? ($_GET['customer'] =='default' ? 0 : 1) : '';
    $addSN=isset($_GET['addSN']) ? $_GET['addSN'] : '';
    $addPN=isset($_GET['addPN']) ? $_GET['addPN'] : '';
    $addOem=isset($_GET['addOem']) ? $_GET['addOem'] : '';
    $lanIp=isset($_GET['lanIp']) ? $_GET['lanIp'] : '';
    $shelf=isset($_GET['shelf']) ? $_GET['shelf'] : '';

    $addFormArray = array('testMachine'=> $testMachine, 'machineId'=> $machineId, 'testItem'=> $testItem, 'testImage'=>$testImage, 'customer'=>$customer,
        'addSN'=>$addSN, 'addPN'=>$addPN, 'addOem'=>$addOem, 'lanIp'=> $lanIp, 'shelf'=>$shelf);

    return $addFormArray;
}