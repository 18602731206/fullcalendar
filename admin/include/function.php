<?php
/*时间处理函数自定义，防止2038年的问题*/
/*返回时间戳格式*/
function strtotime2($timestring=""){
	@date_default_timezone_set("Asia/ShangHai");
	if($timestring)$temp=new DateTime($timestring);
	else           $temp=new DateTime();
	return $temp->format("U");
}

/*返回字符串时间格式*/
function date2($format="Y-m-d H:i:s",$timemap=""){
	@date_default_timezone_set("Asia/ShangHai");
	//无时间戳，则当前时间
	$timemap=($timemap=="")?strtotime2():$timemap;
	$temp=new DateTime("@".$timemap);
	$temp->setTimezone(new DateTimeZone("Asia/ShangHai"));
	return $temp->format($format);	
}

/*返回当前时间戳*/
function time2(){
	return strtotime2();
}

/*生成随机字符*/
function genRandomString($len){
	$chars = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  "m", "n", "p", "q", "r", "s", "t", "u", "v",  "w", "x", "y", "z", "A", "B", "C", "D", "E", "F","G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",  "2",  "3", "4", "5", "6", "7", "8", "9" );
	$charsLen = count($chars) - 1;
	shuffle($chars);
	$output = "";
	for ($i=0; $i<$len; $i++) { $output .= $chars[mt_rand(0, $charsLen)]; }
	return $output;
}

/*附件上传目录*/
function getname($exname){
	$date=new DateTime();	
	$dir = "uploadfile/".$date->format("Y-m")."/";
	if(!is_dir($dir)){mkdir($dir,0777);copy("uploadfile/index.php","{$dir}/index.php");}
	while(true){if(!is_file($dir.$i.".".$exname)){$name=$i.".".$exname;break;} $i++;} return $dir.time().genRandomString(12).$name;
} 

/*字符串剪切*/
function cut($string,$length){
	if (mb_strlen($string, "utf-8") <= $length)return $string;
	return mb_substr($string, 0, $length, "utf-8").'...';
}  
 
/*对javascript的alert()函数进行了php封装，目的是使用方便，如果$msg参数为空，则直接跳转不弹出提示内容*/
function alert($msg,$url='index.php'){
	if($msg){
		echo "<script>$().ready(function(){alert('$msg');location='$url';})</script>";die();
	}
	else {
		echo "<script>$().ready(function(){location='$url';})</script>";die();
	}
}

/*判断管理员是否登录，如果否则跳转到admin.php*/
function getadmin($action='show'){
	global $A;
	$A=@getone("select * from user where username='{$_SESSION['adminname']}' and password='{$_SESSION['adminpassword']}'");
	if(!$A['id']){
		if($action=='show'){
		   $_SESSION['adminname']="";
		   $_SESSION['adminpassword']="";
		   unset($_SESSION['adminname'],$_SESSION['adminpassword']);
		   echo "<script>location='admin_login.php'</script>";
		   die("No permission");
		}
		else return false;
	}
	return true;
}

/*判断会员是否登录，如果否则跳转到member.php*/ 
function checkmember($action='show'){
	global $M;	  
	$M=@getone("select * from member where username='{$_SESSION['membername']}' and password='{$_SESSION['memberpassword']}'");
	if(!$M['id']){
		if($action=='show'){
			$_SESSION['membername']="";
			$_SESSION['memberpassword']="";
			unset($_SESSION['membername'],$_SESSION['memberpassword']);
			echo "<script>location='member.php?action=login'</script>";
			die("No permission");
		}
		else return false;
	}
	return true;
}

/*分页函数*/
function page($countsql,$pagesql,$url,$num=20){
	global $DB_TYPE;
	$str="";
	$page=isset($_GET['page'])?(intval($_GET['page'])>0?intval($_GET['page']):1):1;
    $count=getone($countsql);
	$total=$count['count(*)'];	 
	if($total){
		$total_page=ceil($total/$num);
		$page=($page>$total_page)?$total_page:$page;
		$offset=($page-1)*$num;
		$returns[1]=query($pagesql." limit $offset,$num");
		//
		$str.=" <div class='ex_page_link'>&nbsp;<a href='{$url}&page=1'><span class='ex_page_bottm'><center>首页</center></span></a>";
		$tempshang=$page-1;$tempxia=$page+1;
		if($page!=1) $str.="&nbsp;<a href='{$url}&page={$tempshang}'><span class='ex_page_bottm'><center>上一页</center></span></a>";
		for($i=1;$i<=$total_page;$i++)
		   if($page==$i) $str.="&nbsp;<a href='{$url}&page={$i}'><span class='ex_page_bottm ex_page_sec' style='width:20px;' ><center>{$i}</center></span></a>";
		   else  if($i-$page>=-$num&&$i-$page<=$num) $str.="&nbsp;<a href='{$url}&page={$i}'><span class='ex_page_bottm' style='width:20px;' ><center>{$i}</center></span></a>";
		if($page!=$total_page)  $str.="&nbsp;<a href='{$url}&page={$tempxia}'><span class='ex_page_bottm'><center>下一页</center></span></a>";
		$str.=" 
		&nbsp;<span  class='ex_page_bottm'><center><a href='{$url}&page={$total_page}'>尾页</a></center></span>
		&nbsp;<span  class='ex_page_bottm' ><center>{$page}/{$total_page}</center></span></div>";
		$returns[2]=$str;
		//
		$returns['pl']="
		 <span class='op' onclick=\"SelectAll('selectAll','delform','allidd')\">全选/</span>
		 <span class='op' onclick=\"SelectAll('','delform','allidd')\">反选/</span>
		 <span class='op' onclick=\"SelectAll('selectNo','delform','allidd')\">不选</span>";
		 $returns['pldelete']="<span class='op2' onclick=\"if(checkdelform('delform','allidd')&&confirm('您真的要删除这些内容吗？')) delform.submit()\">批量删除</span>";
		 return $returns;
	}
	else return false;	
}

/*安全性处理，如果魔术引号未开启，则强行使用addslashes函数进行过滤*/		
function escape($str){
	if(!get_magic_quotes_gpc()) return addslashes($str); 
	else return $str; 
}

/*以数组为参数，调用上面的escape()函数，目的是简化代码*/	
function escapeArr($Ar){
	foreach($Ar as $key=>$value){
		$Ar[$key]=escape($value);
	}
	return $Ar;
}

/*从数据库读取信息填充到表单里，通常如果信息中包含引号会造成给中问题，这个函数就是对单双引号就行转码*/	
function fromTableInForm($rs){
	foreach($rs as $key=>$value)$rs[$key]=str_replace(array("'","\""),array("&#39;","&#34;"),$value);
	return $rs;
}

/*判断两个参数是否相等，如果想到则返回 selected  主要用在select表单中用于自动选中某个option*/
function select($a,$b){
	if($a==$b)return " selected";
}


/********************************数据库相关操作******************************************
/*                                                                                    *
/*                                                                                   */
//对mysql_close进行封装，目的是为今后的扩展预留数据库接口，如更换数据库或服务器环境发生变化*
function close(){
	global $conn;
	mysql_close($conn);
}
/*对mysql_query进行封装，目的是为今后的扩展预留数据库接口，如更换数据库或服务器环境发生变化*/
function query($sql){
	global $conn;
	return mysql_query($sql,$conn);
}
/*对mysql_fetch_assoc进行封装，目的是为今后的扩展预留数据库接口，如更换数据库或服务器环境发生变化*/
function fetch($rs){
	return mysql_fetch_assoc($rs);
}
/*取出最近执行的id*/
function insert_id(){
	return mysql_insert_id();
}
/**********将增删改查封装为函数，目的是简化代码***************/
/*新增数据*/
function insert($table,$array){  
	foreach($array as $key=>$value){
		$str.=" `$key`='$value',";
	}
	$str=substr($str,0,strrpos($str,','));
	$sql="insert into `$table` set $str ";
	if(query($sql))return true;else {echo "<b>ERR_SQL:$sql</b><br>";die();}
}
/*更新数据*/
function update($table,$array,$where){   
	foreach($array as $key=>$value){	
	   $str.=" `$key`='$value',";
	}
	$str=substr($str,0,strrpos($str,','));
	$sql="update `$table` set $str where $where";
	if(query($sql))return true;
	else {echo "<b>ERR_SQL:$sql</b><br>";die();}  
} 
/*删除数据*/
function delete($table,$where){
	return query("delete from `$table` where $where");
}
/*取出一条*/
function getone($query){
	return fetch(query($query));
}
/*根据sql语句取出数据，返回数组*/
function getArr($query){
	$arr=array();
	$query=query($query);
	while($row=fetch($query)){
		$arr[]=$row;
	}
	return $arr;
}
?>