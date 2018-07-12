<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/12/2018
 * Time: 2:38 PM
 */


$tt = '../resource/out/Task_1_11_8712117.csv';

//$aa = '../resource/tasks/Task_1_11_8712119.csv';
$aa = 'D:/wnmp/www/ATS/ats/resource/tasks/Task_1_10_8712128.csv';

//rename($tt, $aa);
//copy($tt, $aa);

if (!unlink($aa)){
    echo 111;
}else {
    echo 222;
}