<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:52
 */
session_start();

require_once 'dbConnect.php';

class atsTestTask{

    private $atsTaskInfoTable="ats_testtask_info";

    function getAtsTaskInfoByTaskId($taskId=null){
        $jsonResult = array();

        $sql="select * from $this->atsTaskInfoTable where TaskID=$taskId";
        $conn = getDbConnect();

        $result=mysqli_query($conn, $sql);

        if($result){
            // 返回记录数
            $rowCount=mysqli_num_rows($result);
            // 关联数组 one
            $jsonResult['row']=mysqli_fetch_assoc($result);
            // 释放结果集
            mysqli_free_result($result);

            if ($rowCount){
                $jsonResult['flag'] = true;
            } else {
                $jsonResult['flag'] = false;
            }

        } else {
            $jsonResult['flag'] = false;
        }

        //close
        mysqli_close($conn);
        echo json_encode($jsonResult);

    }

    function getAtsTaskInfoByMultiTaskId($multiTask=null){
        $jsonResult = array();

        $pdoc = getPDOConnect();

        // checkTaskId

        for ($i=0; $i<count($multiTask); $i++) {


        }

        $sql="select * from $this->atsTaskInfoTable where TaskID=$multiTask";
        $conn = getDbConnect();

        $result=mysqli_query($conn, $sql);

        if($result){
            // 返回记录数
            $rowCount=mysqli_num_rows($result);
            // 关联数组 one
            $jsonResult['row']=mysqli_fetch_assoc($result);
            // 释放结果集
            mysqli_free_result($result);

            if ($rowCount){
                $jsonResult['flag'] = true;
            } else {
                $jsonResult['flag'] = false;
            }

        } else {
            $jsonResult['flag'] = false;
        }

        //close
        mysqli_close($conn);
        echo json_encode($jsonResult);

    }
    function insertAtsTaskInfo($addTaskFormData){

        $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        $powId = explode("_",$addTaskFormData['shelf'])[1];
        $lanId = $powId;
        $shelfId = explode("_",$addTaskFormData['shelf'])[0];

        $columns = "`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumber`, ".
            "`DMI_OEMString`, `TestItem`, `TestMachine`, `MachineID`, `PowerID`, `LANID`, `LANIP`, ".
            "`ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`";
        $sql = "insert into $this->atsTaskInfoTable ($columns)".
                " values (NULL, '{$addTaskFormData['testImage']}', '{$addTaskFormData['customer']}', '{$addTaskFormData['addPN']}',".
                "'{$addTaskFormData['addSN']}', '{$addTaskFormData['addOem']}', '{$addTaskFormData['testItem']}', '{$addTaskFormData['testMachine']}', ".
                "'{$addTaskFormData['machineId']}', '{$powId}', '{$lanId}', '{$addTaskFormData['lanIp']}', '{$shelfId}', NULL,  NULL, NULL, NULL, '0', '{$user}')";

        $conn = getDbConnect();

        if (mysqli_query($conn, $sql)) {
            // insert success
            echo "success";
        } else {
            echo "error". "<br>". $sql;
        }


    }



}