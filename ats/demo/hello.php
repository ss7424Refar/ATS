<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-7-7
 * Time: 下午5:44
 */
session_start();
echo $_SESSION['name'];
print_r($_POST);

var_dump($_POST);

$testMachine= "Altair TX CS1(1607124)";
echo  substr($testMachine, 0, stripos($testMachine, "("));