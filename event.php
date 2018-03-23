<?php
include_once("connect.php");
include_once("readydata.php");
//session_start();

$action = $_GET['action'];
$id = (int)$_GET['id'];
switch($action){
	case 'add':
		addform();
		break;
	case 'edit':
		editform($id);
		break;
}


function addform(){
$date = $_GET['date'];
$enddate = $_GET['end'];

if ($_GET['starthour']=="00" or $_GET['endhour']=="00") {
    $starthour = "08";
    $endhour = "23";
}else{
    $starthour = $_GET['starthour'];
    $endhour = $_GET['endhour'];
}

$startmin = $_GET['startmin'];
$endmin = $_GET['endmin'];

//if($date==$enddate) $enddate='';
if(empty($enddate)){
	$display = 'style="display:none"';
	$enddate = $date;
	$chk = '';
}else{
	$display = 'style=""';
	$chk = 'checked';
}
$enddate = empty($_GET['end'])?$date:$_GET['end'];
?>
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1/jquery-ui.css">
<div class="fancy">
	<h3>新建事件</h3>
    <form id="add_form" action="do.php?action=add&calendar=<?php echo $_GET['calendar'];?>" method="post">
    <p>用户姓名：<input type="text" class="input" name="event" id="event" style="width:320px" value="<?php echo RealName(); ?>" readonly="readonly"></p>
    <p>日程内容：<input type="text" class="input" name="info" id="info" style="width:320px" placeholder="请填写内容..."></p>
    <p>开始时间：<input type="text" class="input datepicker" name="startdate" id="startdate" value="<?php echo $date;?>">
    <span id="sel_start" style=""><select name="s_hour">
        <option value="<?php echo $starthour; ?>"><?php echo $starthour; ?></option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>:
    <select name="s_minute">
        <option value="<?php echo $startmin; ?>"><?php echo $startmin; ?></option>
    	<option value="00" >00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p id="p_endtime" <?php echo $display;?>>结束时间：<input type="text" class="input datepicker" name="enddate" id="enddate" value="<?php echo $enddate;?>">
    <span id="sel_end" style=""><select name="e_hour">
        <option value="<?php echo $endhour; ?>"><?php echo $endhour; ?></option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>:
    <select name="e_minute">
        <option value="<?php echo $endmin; ?>"><?php echo $endmin; ?></option>
    	<option value="00">00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p>
    <!--<label><input type="checkbox" value="1" id="isallday" name="isallday"> 全天</label>
    <label style="display: none;"><input type="checkbox" value="1" id="isend" name="isend" <?php echo $chk;?>>结束时间</label>-->
    </p>
    <div class="sub_btn"><input type="submit" class="btn btn_ok" value="确定"> <input type="button" class="btn btn_cancel" value="取消" onClick="$.fancybox.close()"></div>
    </form>
</div>
<?php }

function editform($id){
    $calendar = $_GET['calendar'];
	$query = mysql_query("select * from $calendar where id='$id'");
	$row = mysql_fetch_array($query);
	if($row){
		$id = $row['id'];
		$title = $row['title'];
        $info = $row['info'];
		$starttime = $row['starttime'];
		$start_d = date("Y-m-d",$starttime);
		$start_h = date("H",$starttime);
		$start_m = date("i",$starttime);
		
		$endtime = $row['endtime'];
		if($endtime==0){
			$end_d = $startdate;
			$end_chk = '';
			$end_display = "style='display:none'";
		}else{
			$end_d = date("Y-m-d",$endtime);
			$end_h = date("H",$endtime);
			$end_m = date("i",$endtime);
			$end_chk = "checked";
			$end_display = "style=''";
		}
		
		$allday = $row['allday'];
		if($allday==1){
			$display = "style='display:none'";
			$allday_chk = "checked";
		}else{
			$display = "style=''";
			$allday_chk = '';
		}
	}
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<div class="fancy">
	<h3>编辑事件</h3>
    <form id="add_form" action="do.php?action=edit&calendar=<?php echo $_GET['calendar'];?>" method="post">
    <p>用户姓名：<input type="text" class="input" name="event" id="event" style="width:320px" value="<?php echo $title; ?>" readonly="readonly"></p>
    <input type="hidden" name="id" id="eventid" value="<?php echo $id;?>">
    <p>日程内容：<input type="text" class="input" name="info" id="info" style="width:320px" placeholder="请填写内容..." value="<?php echo $info;?>"></p>
    <p>开始时间：<input type="text" class="input datepicker" name="startdate" id="startdate" value="<?php echo $start_d;?>">
    <span id="sel_start" <?php echo $display;?>><select name="s_hour">
    	<option value="<?php echo $start_h;?>" selected><?php echo $start_h;?></option>
    <!--
        <option value="00">00</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
    -->
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>:
    <select name="s_minute">
    	<option value="<?php echo $start_m;?>" selected><?php echo $start_m;?></option>
    	<option value="00">00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p id="p_endtime" <?php echo $end_display;?>>结束时间：<input type="text" class="input datepicker" name="enddate" id="enddate" value="<?php echo $end_d;?>">
    <span id="sel_end"  <?php echo $display;?>><select name="e_hour">
    	<option value="<?php echo $end_h;?>" selected><?php echo $end_h;?></option>
    <!--
        <option value="00">00</option>
    	<option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
    -->
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>:
    <select name="e_minute">
    	<option value="<?php echo $end_m;?>" selected><?php echo $end_m;?></option>
    	<option value="00">00</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
    </span>
    </p>
    <p>
    <!--<label><input type="checkbox" value="1" id="isallday" name="isallday" <?php echo $allday_chk;?>> 全天</label>
    <label><input type="checkbox" value="1" id="isend" name="isend" <?php echo $end_chk;?>>结束时间</label>-->
    </p>
    <div class="sub_btn"><span class="del"><input type="button" class="btn btn_del" id="del_event" value="删除"></span><input type="submit" class="btn btn_ok" value="确定"> <input type="button" class="btn btn_cancel" value="取消" onClick="$.fancybox.close()"></div>
    </form>
</div>
<?php }?>
<script type="text/javascript" src="js/jquery.form.min.js"></script>

<script type="text/javascript" src="js/datecheck.js"></script>
<script type="text/javascript">
$(function(){
	$(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
	$("#isallday").click(function(){
		if($("#sel_start").css("display")=="none"){
			$("#sel_start,#sel_end").show();
		}else{
			$("#sel_start,#sel_end").hide();
		}
	});
	
	$("#isend").click(function(){
		if($("#p_endtime").css("display")=="none"){
			$("#p_endtime").show();
		}else{
			$("#p_endtime").hide();
		}
		$.fancybox.resize();//调整高度自适应
	});
	
	//提交表单
	$('#add_form').ajaxForm({
		beforeSubmit: showRequest, //表单验证
        success: showResponse //成功返回
    }); 
	
	//删除事件
	$("#del_event").click(function(){
		if(confirm("您确定要删除吗？")){
			var eventid = $("#eventid").val();
			$.post("do.php?action=del&calendar=<?php echo $_GET['calendar'];?>",{id:eventid},function(msg){
				if(msg==1){//删除成功
					$.fancybox.close();
					$('#' + '<?php echo $_GET['calendar'];?>').fullCalendar('refetchEvents'); //重新获取所有事件数据
				}else{
					alert(msg);	
				}
			});
		}
	});
});

function showRequest(){
	var info = $("#info").val();
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
	if(info=="" || startdate=="" || enddate==""){
		alert("请填写完整信息！");
		//$("#info").focus();
		return false;
	}else if (isDate(startdate)!=true) {
        alert("开始日期格式错误!\n\r日期格式：yyyy-mm-dd\n\r例    如：2008-08-08\n\r");
        return false;
    }else if (isDate(enddate)!=true) {
        alert("结束日期格式错误!\n\r日期格式：yyyy-mm-dd\n\r例    如：2008-08-08\n\r");
        return false;
    }else if (startdate > enddate) {
        alert("开始时间不能大于结束时间!");
        return false;
    }
}

function showResponse(responseText, statusText, xhr, $form){
	if(statusText=="success"){	
		if(responseText==1){
			$.fancybox.close();
			$('#' + '<?php echo $_GET['calendar'];?>').fullCalendar('refetchEvents'); //重新获取所有事件数据
		}else{
			alert(responseText);
		}
	}else{
		alert(statusText);
	}
}
</script>