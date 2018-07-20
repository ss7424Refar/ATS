<?php
session_start(); // 初始化session
$_SESSION['name'] = "zhangsan";  //保存某个session信息

?>

<form action="hello.php" method="post">
    Name: <input type="text" name="name" />
    Age: <input type="text" name="age" />
    <input type="submit" />
</form>

