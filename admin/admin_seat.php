<?php
include_once("admin_head.php");
getadmin();
$action=$_GET['action'];
switch($action){	
	case "cz":
		?>
		<form action='?action=czsave' method='post'  onsubmit='return check()' class='myform' style='width:320px;height:100px;'>
        <span class="myspan" style="width:120px;">楼层：</span><select name="floor"><option>全部</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option></select><br />
		<center><input type='submit' value='执行重置' class='submit'></center>
		</form>
		<?php
	break;
	case "czsave":
	    $_POST=escapeArr($_POST);
	    $floor=intval($_POST['floor']);
        if($floor>0) $fsql=" and floor=$floor";
		else $fsql="";
		query("update seat set status=1,mid=null,ptime=null where 1=1 $fsql");
		alert("操作成功！","?action=list");
	break;

	case "plfb":
		?>
		<script>
		function check(){
			if(!$('input[name=num]').val()){alert('座位数不能为空');$('input[name=num]').focus();return false;}
		}
		</script>
		<form action='?action=plsave' method='post'  onsubmit='return check()' class='myform' style='width:420px;height:230px;'>
        <span class="myspan" style="width:120px;">楼层：</span><select name="floor"><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option></select><br />
		<span class="myspan" style="width:120px;">座位数：</span><input name='num' style='width:160px;' value=''><br>
		<center><input type='submit' value='保存' class='submit'></center>
		</form>
		<?php
	break;
	case "plsave":
	    $_POST=escapeArr($_POST);
	    $floor=intval($_POST['floor']);
		$_POST['num']=intval($_POST['num']);
		query("delete from seat where floor=$floor");
		while($_POST['num']>0){
			$dataArr=array();
			$dataArr['floor']=$floor;
			$dataArr['num']=str_pad($_POST['num'],3,'0',STR_PAD_LEFT);
			insert("seat",$dataArr);
			$_POST['num']--;
		}
		alert("操作成功！","?action=list");
	break;
	
	case "insert":
		$Arr=array();
		if(isset($_GET['id'])&&$_GET['id']){
			$id=intval($_GET['id']);
			$Arr=getone("select * from seat where id='$id'");
			$Arr=fromTableInForm($Arr);
		}
		?>
		<script>
		function check(){
			if(!$('input[name=num]').val()){alert('座位号不能为空');$('input[name=num]').focus();return false;}
		}
		</script>
		<form action='?action=save&id=<?php echo $id?>' method='post'  onsubmit='return check()' class='myform' style='width:420px;height:230px;'>
        <span class="myspan" style="width:120px;">楼层：</span><select name="floor">
        <option <?php echo select($Arr['floor'],"6")?>>6</option>
        <option <?php echo select($Arr['floor'],"5")?>>5</option>
        <option <?php echo select($Arr['floor'],"4")?>>4</option>
        <option <?php echo select($Arr['floor'],"3")?>>3</option>
        <option <?php echo select($Arr['floor'],"2")?>>2</option>
        <option <?php echo select($Arr['floor'],"1")?>>1</option>
        </select><br />
		<span class="myspan" style="width:120px;">座位号：</span><input name='num' style='width:160px;' value='<?php echo $Arr['num']?>'><br>
 		<span class="myspan" style="width:120px;">状态：</span><select name='status'>
		<option value="2" <?php echo select($Arr['status'],"2")?>>已占用</option>
		<option value="1" <?php echo select($Arr['status'],"1")?>>未占用</option>
		</select>
        <br> 
		<center><input type='submit' value='保存' class='submit'></center>
		</form>
		<?php
	break;
	  
	case "save":
		$_POST=escapeArr($_POST);
		if(isset($_GET['id'])&&$_GET['id']){
            $id=intval($_GET['id']);
			update("seat",$_POST,"id=$id");
		}
		else{
            die();
		}
		alert("操作成功！","?action=list");
	break;	 
	  
	case "alldel":
		$key=isset($_POST["allidd"])&&$_POST["allidd"]?$_POST["allidd"]:array(intval($_GET['id']));
		for($i=0;$i<count($key);$i++){
		    query("delete from seat where id={$key[$i]}"); 
		}
		alert("成功删除".count($key)."条信息！","?action=list");
	break;
	
	case "list":
		echo "<form style='padding:0px;margin:0px;' action='?action=list' method='post'>
		<span class='status'>&nbsp;&nbsp;<i>座位管理</i></span>&nbsp;&nbsp;&nbsp;&nbsp;
		楼层：<select name='floor'><option>不限</option>
		<option ".select("6",$_REQUEST['floor']).">6</option>
		<option ".select("5",$_REQUEST['floor']).">5</option>
		<option ".select("4",$_REQUEST['floor']).">4</option>
		<option ".select("3",$_REQUEST['floor']).">3</option>
		<option ".select("2",$_REQUEST['floor']).">2</option>
		<option ".select("1",$_REQUEST['floor']).">1</option>
		</select>
		状态：<select name='status'>
		<option>不限</option>
		<option value='2' ".select($_REQUEST['status'],"2").">已占用</option>
		<option value='1' ".select($_REQUEST['status'],"1").">未占用</option>
		</select>
		会员名：<input name='s_username' value='{$_REQUEST['s_username']}'>
		<input type='submit' value='搜索'>   <input type='button' onclick=\"location='?action=plfb'\" value='发布'>
		 <input type='button' onclick=\"location='?action=cz'\" value='重置'></form>";   
		$fsql="";$fpage="";  
		if(isset($_REQUEST['s_username'])&&$_REQUEST['s_username']){
 			$fsql.=" and mid in (select id from member where username like '%{$_REQUEST['s_username']}%')";
			$fpage.="&s_username={$_REQUEST['s_username']}";			
		}
 		if(isset($_REQUEST['floor'])&&$_REQUEST['floor']!="不限"){
 			$fsql.=" and floor='{$_REQUEST['floor']}'";
			$fpage.="&floor={$_REQUEST['floor']}";			
		}
 		if(isset($_REQUEST['status'])&&$_REQUEST['status']!="不限"){
 			$fsql.=" and status='{$_REQUEST['status']}'";
			$fpage.="&status={$_REQUEST['status']}";			
		}
		$countsql="select count(*) from seat where 1=1 $fsql";
		$pagesql="select * from  seat where 1=1 $fsql order by id desc";
		$bottom="?action=list{$fpage}";
		$datasql=page($countsql,$pagesql,$bottom,15);
		echo "<form name='delform' id='delform' action='?action=alldel' method='post' class='margin0'>
		<table style='width:98%;' align='center'>";
		if($datasql){
		echo "<tr  bgcolor='#eeeeee' height='30' align='center'>
		<td style='width:10px'></td><td>楼层</td><td>座位号</td><td>状态</td><td>会员</td><td>时间</td><td>管理</td></tr>";	
		while($rs=fetch($datasql[1])){
		  $member=getone("select * from member where id='{$rs['mid']}'");
		  echo "<tr height='20' onmouseover=\"this.bgColor = '{$W['tr_color']}'\" onmouseout=\"this.bgColor = ''\">
			  <td><input   type=checkbox value='{$rs['id']}'  name='allidd[]' id='allidd'></td>
			  <td align='center'>{$rs['floor']}</td>
			  <td align='center'>{$rs['num']}</td>
			  <td align='center'>";echo $rs['status']==1?"未占用":"<span color='#ff0000'>已占用</span>"; echo"</td>
              <td align='center'>{$member['username']}</td>
			  <td align='center'>"; echo $rs['ptime']?date2("Y-m-d H:i:s",$rs['ptime']):""; echo "</td>
			  <td align='center'>
			  <a href='?action=insert&id={$rs['id']}'>编辑</a>  &nbsp; &nbsp;
			  <a href='javascript:ask(\"?action=alldel&id={$rs['id']}\")'>删除</a>  &nbsp; &nbsp; 
			  </td>
			  </tr>";
		}
		echo "<tr><td colspan=11 align='right'>
					 <div style='width:280px;float:left'>{$datasql['pl']}{$datasql['pldelete']}</div>
					 <div  style='float:right'>{$datasql[2]}</div>
					 <div style='clear:both;'></div>
			  </td></tr>";
		}
		echo "</table></form>";
	break;
}
include_once("admin_foot.php");
?>