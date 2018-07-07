<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-1
 * Time: 上午9:13
 */

$path='../resource/TestPC.csv';
$file = fopen($path,'r');

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