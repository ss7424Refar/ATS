<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 6/28/2018
 * Time: 2:06 PM
 */

require_once '../ats_config.inc.php';

$query = isset($_GET['q']) ? $_GET['q'] : '';
$handler = opendir(ATS_IMAGES_PATH);

$i = 1;
$jsonResult = array();

while (($filename = readdir($handler)) !== false) {
    //略过linux目录的名字为'.'和‘..'的文件
    if ($filename != "." && $filename != "..") {
        if (empty(trim($query))) {
            $tmpArray = array('id' => $i, 'text' => $filename);
            $i = $i + 1;
            array_push($jsonResult, $tmpArray);
        } else {
            if (stristr($filename, $query) !== false) {
                $tmpArray = array('id' => $i, 'text' => $filename);
                $i = $i + 1;
                array_push($jsonResult, $tmpArray);
            }
        }
    }
}

echo json_encode($jsonResult);