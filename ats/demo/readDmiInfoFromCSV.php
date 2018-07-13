<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-1
 * Time: 上午9:13
 */

require_once '../ats_config.inc.php';
$file = fopen(ATS_PREPARE_PATH. ATS_PREPARE_FILE. ATS_FILE_suffix,'r');

$machineId=isset($_GET['machineId']) ? $_GET['machineId'] : '';

$jsonResult=array();
$line=0;

if(!empty($machineId)){
    while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
        $line++;
        if ($line>=2){
            if ($data[2] == $machineId){
                $tmpArray = array('sn' => $data[7], 'pn' => $data[8], 'oem' => $data[9], 'lanIp' => $data[3], 'shelfId' => $data[0]);
                array_push($jsonResult, $tmpArray);
            }
        }

    }

}

echo json_encode($jsonResult);