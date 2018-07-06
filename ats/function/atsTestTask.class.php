<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:52
 */

require_once 'dbConnect.php';

class atsTestTask{

    private $atsTaskInfoTable="ats_testtask_info";

    function checkTaskIdExist($taskId=null){

        $sql="select * from $this->atsTaskInfoTable where TaskID=$taskId";
        $conn=getDbConnect();

        $result=mysqli_query($conn, $sql);

        if($result){
            // 返回记录数
            $rowCount=mysqli_num_rows($result);
            // 释放结果集
            mysqli_free_result($result);

            if ($rowCount){
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }

        } else {
            echo json_encode(false);
        }

        //close
        mysqli_close($conn);

    }

    function insertAtsTaskInfo($addTaskFormData){
        $columns = "`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumer`, ".
            "`DMI_OEMString`, `TestItem`, `TestMachine`, `MachineID`, `PowerID`, `LANID`, `LANIP`, ".
            "`ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`";
        $sql = "insert into $this->atsTaskInfoTable ($columns) values (NULL ,'TI10661700B', '1', 'PT24C', 'ZD102073H', 'PT24C--ZD', 
                                                            'JumpStart', 'Altair TX20 CS2 SKU2', '1308044', '1', '1', '1', '1', 'pass', '192.168.10.43//test',
                                                             '2009-06-08 23:53:17', '2009-06-08 23:53:17', 
                                                             '1', 'Xu.wanliang')";

    }



}