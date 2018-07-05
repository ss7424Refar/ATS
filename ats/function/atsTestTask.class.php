<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:52
 */

require_once 'dbConnect.php';

class atsTestTask{

    private $tableName="ats_testtask_info";

    function checkTaskIdExist($taskId=null){

        $sql="select * from $this->tableName where TaskID=$taskId";
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




}