<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-25
 * Time: 上午9:52
 */
session_start();

require_once 'atsDbConnect.php';
require_once '../ats_config.inc.php';

class atsTestTask{

    private $atsTaskInfoTable="ats_testtask_info";
    private $atsScheduleInfoTable="ats_schedule_info";

    function readTestPCInfo(){
        $file = fopen(ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix,'r');

        $machineId=isset($_GET['machineId']) ? $_GET['machineId'] : '';

        $jsonResult=array();
        $line=0;

        if(!empty($machineId)){
            while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
                $line++;
                if ($line>=2){
                    if ($data[2] == $machineId){
                        $tmpArray = array('product'=> $data[6], 'sn' => $data[7], 'pn' => $data[8], 'oem' => $data[9], 'sys'=> $data[10], 'lanIp' => $data[3], 'shelfId' => $data[0]);
                        array_push($jsonResult, $tmpArray);
                    }
                }

            }

        }
        echo json_encode($jsonResult);
        fclose($file);
    }

    function readMachine4Select2(){
        $file = fopen(ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix,'r');
        $query = isset($_GET['q']) ? $_GET['q'] : '';

        $jsonResult=array();
        $line=0;
        while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
            $line++;
            if ($line>=2){
                $machineId=$data[2];
                $appendedTestMachine=$data[1]. "(". $data[2]. ")" ;
                if (empty(trim($query))) {
                    $tmpArray = array('id' => $data[1], 'text' => $appendedTestMachine);
                    array_push($jsonResult, $tmpArray);
                }else {
                    if (stristr($appendedTestMachine, $query) !== false){
                        $tmpArray = array('id' => $data[1], 'text' => $appendedTestMachine);
                        array_push($jsonResult, $tmpArray);
                    }

                }

            }

        }
        echo json_encode($jsonResult);

        fclose($file);
    }

    function getImageName4Select2(){
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        $handler = opendir(ATS_IMAGES_PATH);

        $i = 1;
        $jsonResult = array();

        while (($filename = readdir($handler)) !== false) {
            //略过linux目录的名字为'.'和‘..'的文件
            if ($filename != "." && $filename != "..") {
                if (empty(trim($query))) {
                    $tmpArray = array('id' => $filename, 'text' => $filename);
                    $i = $i + 1;
                    array_push($jsonResult, $tmpArray);
                } else {
                    if (stristr($filename, $query) !== false) {
                        $tmpArray = array('id' => $filename, 'text' => $filename);
                        $i = $i + 1;
                        array_push($jsonResult, $tmpArray);
                    }
                }
            }
        }

        echo json_encode($jsonResult);
    }
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

    function checkAtsInfoByMultiTaskId($multiTask=null){
        $jsonResult = array();

        $pdoc = getPDOConnect();
        // pdo
        $sql="select * from $this->atsTaskInfoTable where TaskID=?";
        $stmt = $pdoc->prepare($sql);

        $saveNoTaskId = '';
        $saveNotPending = '';
        for ($i = 0; $i < count($multiTask); $i++) {
            if($stmt->execute(array($multiTask[$i]['TaskID']))){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // checkTaskId
                if (!$row) {
                    $saveNoTaskId = $saveNoTaskId . $multiTask[$i]['TaskID']. ',';
                }else{
                    // pending check
                    if (0 != $row['TaskStatus']){
                        $saveNotPending = $saveNotPending. $multiTask[$i]['TaskID']. ',';
                    }
                }
            }
        }

        $jsonResult['NoTaskIdFlag'] = empty($saveNoTaskId) ? false : true;
        $jsonResult['saveNoTaskId'] = !empty($saveNoTaskId) ? substr($saveNoTaskId, 0 , strlen($saveNoTaskId) - 1) : '';
        $jsonResult['NotPendingFlag'] = empty($saveNotPending) ? false : true;
        $jsonResult['saveNotPending'] = !empty($saveNotPending) ? substr($saveNotPending, 0 , strlen($saveNoTaskId) - 1) : '';

        echo json_encode($jsonResult);
        $pdoc = null;
    }

    function assignAtsInfoByMultiTaskId($multiTask=null){
        // pdo
        $pdoc = getPDOConnect();

//        $sql4Schedule="insert into  $this->atsScheduleInfoTable select * from  $this->atsTaskInfoTable where TaskID=?";
        $sql4TestTask="update $this->atsTaskInfoTable  set TaskStatus = '1', TestStartTime = now() where TaskID=?";
        $sql4SelectTask="select * from $this->atsTaskInfoTable where TaskID=?";

        // extract
        $stmt = $pdoc->prepare($sql4SelectTask);
        for ($i = 0; $i < count($multiTask); $i++) {
            $stmt->execute(array($multiTask[$i]['TaskID']));
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $filePath = ATS_TMP_TASKS_PATH;
                $fileName = ATS_TMP_TASKS_HEADER. $row['ShelfID']. ATS_FILE_UNDERLINE. $row['SwitchId'].
                    ATS_FILE_UNDERLINE. $multiTask[$i]['TaskID']. ATS_FILE_suffix;
                $fileCreate = $filePath. $fileName;
                $file = fopen($fileCreate,"x+");
                foreach ($row as $key=>$value){
                    if(null == $value){
                        $value='NULL';
                    }
                    $str = $key. '='. $value.PHP_EOL;
                    file_put_contents($fileCreate, $str,FILE_APPEND);

                }
                fclose($file);
                // unix
                chmod($fileCreate, 0777); // no effect

                if(!copy($fileCreate, ATS_TASKS_PATH. $fileName) || !unlink($fileCreate)){
                    echo json_encode($multiTask[$i]['TaskID']. " copy or delete fail".
                        copy($fileCreate, ATS_TASKS_PATH. $fileName). '_'. unlink($fileCreate));
                    exit();
                } else {
                    // update
                    $stmtUpdate = $pdoc->prepare($sql4TestTask);
                    $stmtUpdate->bindParam(1, $multiTask[$i]['TaskID']);
                    $stmtUpdate->execute();
                }
            }
        }
        echo json_encode("done");
    }

    function insertAtsTaskInfo($addTaskFormData){

        $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        $switchId = explode("_",$addTaskFormData['shelf'])[1];
        $shelfId = explode("_",$addTaskFormData['shelf'])[0];

        $columns = "`TaskID`, `TestImage`, `DMIModifyFlag`, `DMI_PartNumber`, `DMI_SerialNumber`, `DMI_ProductName`,".
            "`DMI_OEMString`, `DMI_SystemConfig`, `TestItem`, `TestMachine`, `MachineID`, `LANIP`, `SwitchId`, ".
            "`ShelfID`, `TestResult`, `TestResultPath`, `TestStartTime`, `TestEndTime`, `TaskStatus`, `Tester`";
        $sql = "insert into $this->atsTaskInfoTable ($columns)".
                " values (NULL, '{$addTaskFormData['testImage']}', '{$addTaskFormData['customer']}', '{$addTaskFormData['addPN']}',".
                " '{$addTaskFormData['addSN']}', '{$addTaskFormData['product']}', '{$addTaskFormData['addOem']}',  '{$addTaskFormData['addSystem']}', '{$addTaskFormData['testItem']}', '{$addTaskFormData['testMachine']}', ".
                "'{$addTaskFormData['machineId']}', '{$addTaskFormData['lanIp']}', '{$switchId}', '{$shelfId}',  NULL,  NULL, NULL, NULL, '0', '{$user}')";

        $conn = getDbConnect();

        if (mysqli_query($conn, $sql)) {
            // insert success
            echo "success";
        } else {
            echo "error". "<br>". $sql;
        }
    }

    function deleteAtsInfoByMultiTaskId($multiTask=null){
        $sql = "delete from  $this->atsTaskInfoTable where TaskID = ?";
        $pdoc = getPDOConnect();

        $stmt = $pdoc->prepare($sql);
        for ($i = 0; $i < count($multiTask); $i++) {
            $stmt->execute(array($multiTask[$i]['TaskID']));

            if (! $stmt->rowCount() > 0){
                echo "error". "<br> when delete ". $multiTask[$i]['TaskID'];
                exit();
            }
        }
        echo "done";

    }

}