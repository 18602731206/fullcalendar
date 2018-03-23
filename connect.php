<?php
$host="127.0.0.1";
$db_user="root";
$db_pass="root";
$db_name="wuda";
$timezone="Asia/Shanghai";

/*  $con=mysqli_connect("localhost","root","root","wuda"); 
if (mysqli_connect_errno($con)) 
{ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
}  */
$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间
?>
