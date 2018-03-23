<?php
session_start();
include_once('include/db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="images/inc.css" rel="stylesheet" />
<title>用户管理系统</title>
<script src="include/jquery-1.3.2.min.js"></script>
<script src="include/function.js"></script>
<script>
/*显示子菜单*/
function showmt(obj){
	$('#bodyleft').find("div").hide();	
	$(obj).next().css({"background-color":"#ffffff","border-bottom":"solid 1px #333","border-top":"solid 1px #333"});
	$(obj).next().toggle(300);
}
$(window).resize(function() {  
    changsize(); 
});

$().ready(function(){
	changsize();
	showmt($("#default"));
})
function changsize(){
	with(document.documentElement) {
		bodywidth=(scrollWidth>clientWidth)?scrollWidth:clientWidth;
		bodyheight= clientHeight;
	}
	var bodyleft=200;var bodytop=120;
	var bodyright=bodywidth-bodyleft-5;//-5考虑到浏览器兼容性
	var bodyheight=bodyheight-bodytop;
	//1、定义顶部高度
	$('.bodytop').css({'height':bodytop+'px'});
	//2、定义左侧菜单宽度和高度 
	$('#bodyleft').css({'width':bodyleft+'px'});
	$('#bodyleft').css({'height':bodyheight+'px'});
	//3、定义右侧层的高度和宽度
	$('#bodyright').css({'width':bodyright+'px'});
	$('#bodyright').css({'height':bodyheight+'px'});
	//4、定义iframe框架的高度和宽度
	$("#mainframe").css({'width':bodyright+'px'});
	$("#mainframe").css({'height':bodyheight+'px'});
}
</script>
</head>
<style>
/*admin.php*/
.bodytop{border-bottom:solid 3px #666}
.bodytop div{background:url(images/top.png?v=1) no-repeat;height:120px;}
.bodyleft   {font-size:14px;line-height:2.5;float:left;background-color:#eee;}
.bodyleft  A:visited,.bodyleft A:link,.bodyleft A:hover {text-decoration:none;COLOR: #000;} 
.bodyleft  span.mt{cursor:pointer;display:inline-block;width:100%;height:50px;border-right:solid 1px #333; text-align:center; font-weight:bold; line-height:50px;}
.bodyleft  span.md{display:inline-block;width:100%;height:50px; text-indent:60px;line-height:50px;}
.bodyright{float:right; margin:auto;}
</style>
<body style="overflow:hidden;">
<header class='bodytop'><div></div></header>
<nav class='bodyleft' id='bodyleft'>
    <span class='mt'  onClick="showmt(this)">快捷通道</span>
    <div>
        <span class='md'>▶ &nbsp; <a href='../index.html' target="_blank">前台首页</a></span><br />
        <span class='md'>▶ &nbsp; <a href="javascript:void(0);" onClick="if(confirm('您真的要退出吗？'))window.open('admin_login.php?action=logout','mainframe');;">退出登录</a></span><br />
    </div>
    
    <span class='mt' id='default' onClick="showmt(this)">系统管理</span>
    <div>
        <span class='md'>▶ &nbsp; <a href='admin_user.php?action=insert' target="mainframe">新增管理员</a></span><br />
        <span class='md'>▶ &nbsp; <a href='admin_user.php?action=list' target="mainframe">管理员列表</a></span><br />
    </div>
    
    <span class='mt' onClick="showmt(this)">用户管理</span>
    <div>
        <span class='md'>▶ &nbsp; <a href='admin_member.php?action=insert' target="mainframe">新增用户</a></span><br />
        <span class='md'>▶ &nbsp; <a href='admin_member.php?action=list' target="mainframe">用户列表</a></span><br />
    </div>   
    
    
      
 
    <span class='mt'  onClick="showmt(this)" style="height:100%">&nbsp;</span>

</nav>

<section align="left" id='bodyright' class="bodyright">
    <iframe id='mainframe' class='mainframe' name='mainframe'  frameborder="0" scrolling="yes" src="admin_login.php"></iframe>
</section>
</body>
</html>
<?php close();?>