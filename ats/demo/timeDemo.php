<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 7/13/2018
 * Time: 9:53 AM
 */
//var_dump(time());
$a = filectime('ats.sql');

//echo "修改时间：".date("Y-m-d H:i:s",$a);

//echo time();

$time1 = strtotime("2017-5-15");
$time2 = strtotime("2017-4-15");

if ($tim1 - $time2 < 0) {
    echo 'hhh';
}