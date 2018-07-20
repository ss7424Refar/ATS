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
        case 'readTestPCInfo':
            $atsTask->readTestPCInfo();
            break;
        case 'readMachine4Select2':
            $atsTask->readMachine4Select2();
            break;
        case 'getImageName4Select2':
            $atsTask->getImageName4Select2();
            break;
        case 'getAtsInfoByTaskId':
            $taskID=isset($_GET['taskID']) ? $_GET['taskID'] : 0;
            $atsTask->getAtsTaskInfoByTaskId($taskID);
            break;
        case 'checkAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->checkAtsInfoByMultiTaskId($multiTask);
            break;
        case 'assignAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->assignAtsInfoByMultiTaskId($multiTask);
            break;
        case 'deleteAtsInfoByMultiTaskId':
            $multiTask=isset($_GET['multiTask']) ? $_GET['multiTask'] : 0;
            $atsTask->deleteAtsInfoByMultiTaskId($multiTask);
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
    $addProduct=isset($_GET['addProduct']) ? $_GET['addProduct'] : '';
    $addSN=isset($_GET['addSN']) ? $_GET['addSN'] : '';
    $addPN=isset($_GET['addPN']) ? $_GET['addPN'] : '';
    $addOem=isset($_GET['addOem']) ? $_GET['addOem'] : '';
    $addSystem=isset($_GET['addSystem']) ? $_GET['addSystem'] : '';
    $lanIp=isset($_GET['lanIp']) ? $_GET['lanIp'] : '';
    $shelf=isset($_GET['shelf']) ? $_GET['shelf'] : '';

    $addFormArray = array('testMachine'=> $testMachine, 'machineId'=> $machineId, 'testItem'=> $testItem, 'testImage'=>$testImage, 'customer'=>$customer, 'product'=>$addProduct,
        'addSN'=>$addSN, 'addPN'=>$addPN, 'addOem'=>$addOem, 'addSystem'=> $addSystem, 'lanIp'=> $lanIp, 'shelf'=>$shelf);

    return $addFormArray;
}