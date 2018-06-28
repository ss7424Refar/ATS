<?php
/**
 * Created by PhpStorm.
 * User: JuL
 * Date: 6/28/2018
 * Time: 2:06 PM
 */

$path = 'D:\download';
$handler = opendir($path);

while( ($filename = readdir($handler)) !== false )
{
    //略过linux目录的名字为'.'和‘..'的文件
    if($filename != "." && $filename != "..")
    {
        //输出文件名
        $filename = iconv("gbk","utf-8",$filename);
        echo $filename;
    }
}