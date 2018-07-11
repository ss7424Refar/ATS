<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/10/2018
 * Time: 4:32 PM
 */

//require_once '../ats_config.inc.php';
require_once '../function/dbConnect.php';

$pdoc = getPDOConnect();
//$filePath = __DIR__. '\writeTo.csv';
//echo $filePath;
$file = fopen('writeTo.csv','w');
// checkTaskId
$sql="select * from ats_testtask_info where TaskID=?";
$stmt = $pdoc->prepare($sql);

    if($stmt->execute(array(8712128))){
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            print_r($row);
//            echo count($row);

            // output to csv
//            fputcsv($file, $row, ',', '"');

            foreach ($row as $key=>$value){
                if(empty($value)){
                    $value='NULL';
                }
                $str = $key. ' : '. $value.PHP_EOL;
                echo $str;
                file_put_contents('writeTo.csv',$str,FILE_APPEND);
            }

        } else{
            echo "111";
        }
    }
