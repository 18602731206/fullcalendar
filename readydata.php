<?php
	include_once('connect.php');
    session_start();
    $room = $_GET['room'];//会议室编号 

    //查询登录用户的真实姓名
    function RealName(){
    	$loginuser = $_SESSION['membername'];
	    $query = mysql_query("select `realname` from `member` where username='$loginuser'");
		$realname = mysql_fetch_array($query);
		return $realname['realname'];
    }

    //返回当前页面的会议室名字
    function RoomName(){
        global $room;
        $room_name = "125会议室";
        $room_name2 = "第三报告厅";
        $room_name3 = "二号楼328会议室";
        $room_name4 = "二楼报告厅";
        $room_name5 = "四楼会议室";
        $room_name6 = "四楼小会议室";
        $room_name7 = "四楼休闲厅";
        switch ($room) {
            case '':
                return $room_name;
                break;

            case '2':
                return $room_name2;
                break;

            case '3':
                return $room_name3;
                break;

            case '4':
                return $room_name4;
                break;

            case '5':
                return $room_name5;
                break;

            case '6':
                return $room_name6;
                break;

            case '7':
                return $room_name7;
                break;
            
            default:
                return $room_name;
                break;
        }
    }

?>