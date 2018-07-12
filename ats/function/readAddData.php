<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-30
 * Time: 下午4:25
 */

require_once '../ats_config.inc.php';

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
            $tmpArray = array('id' => $machineId, 'text' => $appendedTestMachine);
            array_push($jsonResult, $tmpArray);
        }else {
            if (stristr($appendedTestMachine, $query) !== false){
                $tmpArray = array('id' => $machineId, 'text' => $appendedTestMachine);
                array_push($jsonResult, $tmpArray);
            }

        }

    }

}
echo json_encode($jsonResult);

fclose($file);