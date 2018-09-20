<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/10/2018
 * Time: 4:32 PM
 */

//require_once '../ats_config.inc.php';
require_once '../function/atsDbConnect.php';

$pdoc = getPDOConnect();
//$filePath = __DIR__. '\writeTo.csv';
//echo $filePath;
//$file = fopen('writeTo.csv','w');
// checkTaskId
$sql="select * from ats_testtask_info where TaskID=?";
$stmt = $pdoc->prepare($sql);

    if($stmt->execute(array(123))){
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

//
        } else{
            echo "111";
        }


    }

// extract
$sql4SelectTask="select * from ats_schedule_info where TaskID=?";
$stmt = $pdoc->prepare($sql4SelectTask);
$multiTask = array(array('TaskID' => 8712119));
//print_r(count($multiTask));
for ($i = 0; $i < count($multiTask); $i++) {
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $key=>$value){
            if(!isset($value)){
                $value='NULL';
            }
            $str = $key. '='. $value.PHP_EOL;
            $fileName = ATS_TMP_TASKS_PATH. ATS_TMP_TASKS_HEADER. $row['ShelfID']. ATS_FILE_UNDERLINE. $row['LANID'].
                ATS_FILE_UNDERLINE. $multiTask[$i]['TaskID']. ATS_FILE_suffix;
            echo $fileName;
            if ($file = fopen($fileName,"x")){
                file_put_contents($fileName,$str,FILE_APPEND);
//                        rename($fileName, ATS_TASKS_PATH);
                fclose($file);
            }
        }

    }
}