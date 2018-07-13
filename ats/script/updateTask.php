<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/13/2018
 * Time: 9:05 AM
 */

require_once '../function/dbConnect.php';
require_once '../ats_config.inc.php';

//echo 'hello';
$conn = getDbConnect();
$sql4GetSystem = "select * from ats_system_config where name = 'FinishTimeStamp'";
$sql4InsertSystem = "INSERT INTO `ats_system_config` (`name`, `value`) VALUES ('FinishTimeStamp', unix_timestamp());";
$sql4UpdateSystem = "UPDATE ats_system_config` SET `value`='1531447322' WHERE `name`='FinishTimeStamp'";

//var_dump(time());
$a = filectime('ats.sql');

//echo "修改时间：".date("Y-m-d H:i:s",$a);

//echo time();

$result = mysqli_query($conn, $sql4GetSystem);

if (mysqli_num_rows($result) > 0){
    $handler = opendir(ATS_FINISH_PATH);
    // db
    $saveTimeStamp = mysqli_fetch_array($result)[1];

    echo $saveTimeStamp. '<br>';
    while (($filename = readdir($handler)) !== false) {
        //略过linux目录的名字为'.'和‘..'的文件
        if ($filename != "." && $filename != "..") {
            $fileTimeStamp = filectime($filename);

            if ($fileTimeStamp - $saveTimeStamp > 0) {




            }

        }
    }


} else {


}


