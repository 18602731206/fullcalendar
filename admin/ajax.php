<?php
session_start();
include_once('include/db.php');
$action=isset($_GET['action'])?$_GET['action']:"yd";
switch($action){
	case "yd":
	    $id=intval($_POST['id']);
		$mynum=getone("select count(*) from seat where mid='{$M['id']}'");
		$seat=getone("select * from seat where id=$id");
	    if(!$M['id']){
			echo "alert('操作失败：请先登录！');";
			die();
		}
		if($seat['status']==2){
			echo "alert('操作失败：该座位已被预订！');";
			echo "$('#seat{$id}').css({'background-color':'#ff0000'});";
			die();
		}
		if($mynum['count(*)']>=5){
			echo "alert('操作失败：您已经预定过{$mynum['count(*)']}个座位了！');";
			die();
		}
		query("update seat set status=2,mid='{$M['id']}',ptime=".time2()." where id='$id'");
		echo "$('#seat{$id}').css({'background-color':'#06c'});";
		echo "$('#seat{$id}').attr('onclick','cx($id)')";
	break;
	case "cx":
	    $id=intval($_POST['id']);
		$seat=getone("select * from seat where id=$id");
        if($seat['mid']!=$M['id']&&!$A['id']){
			echo "alert('操作失败：无权限！');";
			die();
		}
	    query("update seat set status=1,mid=null,ptime=null where id='$id'");
		echo "$('#seat{$id}').css({'background-color':'#eee'});";
		echo "$('#seat{$id}').attr('onclick','yd($id)')";
	break;
}
?>