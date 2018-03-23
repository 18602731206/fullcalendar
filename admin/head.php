<?php
session_start();
include_once('include/db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="images/inc.css?v=1"  rel="stylesheet" />
<title>座位在线预订系统</title>
<script src="include/jquery-1.3.2.min.js"></script>
<script src="include/function.js"></script>
</head>
<body>
<header class='top'><div class='logo'>座位在线预订系统</div></header>
<section class='main'>
    <nav class='menu'>
    <?php
    if($M['id']){
        ?>
        <div style="width:200px;height:100px; float:left"><img src="<?php echo $M['picurl']?>"  style='width:80px;height:100px'></div>
        <div style="width:700px;height:100px; float:right; line-height:3">
         尊敬的会员<?php echo $M['username']?> 您好<br>
        <a href='index.php'  class='member'>返回首页</a>  |  
        <a href='member.php?action=logOut' class='member'>退出登录</a>  |  
        <a href='member.php?action=register' class='member'>编辑账号</a>  |
        <a href='admin.php' class='member'>管理后台</a>
        </div>
        <div style="clear:both"></div>
        <?php
    }
    else {
       ?>
       尊敬的访客您好，您可以：
        <a href='index.php' class='guest'>系统首页</a>  |   
        <a href='member.php?action=register' class='guest'>会员注册</a>  | 
        <a href='member.php?action=login' class='guest'>会员登录</a>  |
        <a href='admin.php' class='guest'>管理后台</a>  |
       <?php
    }
    ?>
    </nav>
