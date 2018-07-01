<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-1
 * Time: 上午9:13
 */

$path='../resource/TestPC.csv';
$file = fopen($path,'r');

$switchId=isset($_GET['switchId']) ? $_GET['switchId'] : '';

$jsonResult=array();
$line=0;

if(!empty($switchId)){
    while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
        $line++;
        if ($line>=2){
            if (stristr($data[5], $switchId) !== false){
                $tmpArray = array('sn' => $data[7], 'pn' => $data[8], 'oem' => $data[9]);
                array_push($jsonResult, $tmpArray);
            }
        }

    }

}

echo json_encode($jsonResult);