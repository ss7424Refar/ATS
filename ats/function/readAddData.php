<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-6-30
 * Time: 下午4:25
 */

$path='../resource/TestPC.csv';

$file = fopen($path,'r');
$query = isset($_GET['q']) ? $_GET['q'] : '';

$jsonResult=array();
$line=0;
while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
    $line++;
    if ($line>=2){
        if (empty(trim($query))) {
            $tmpArray = array('id' => $data[0], 'text' => $data[1]);
            array_push($jsonResult, $tmpArray);
        }else {
            if (stristr($data[1], $query) !== false){
                $tmpArray = array('id' => $data[0], 'text' => $data[1]);
                array_push($jsonResult, $tmpArray);
            }

        }

    }

}
echo json_encode($jsonResult);

fclose($file);