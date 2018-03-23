<?php include_once("readydata.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>会议室预订系统</title>
<meta name="keywords" content="日程安排,FullCalendar,日历,JSON,jquery实例">
<meta name="description" content="在线演示FullCalendar拖动与保存日程事件的示例。">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/fullcalendar.css">
<link href="assets/styles.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="css/fancybox.css">
<link rel="stylesheet" type="text/css" href="css/button.css">
<style type="text/css">
#calendar{width:95%; margin:20px auto 10px auto}
.fancy{width:450px; height:auto}
.fancy h3{height:30px; line-height:30px; border-bottom:1px solid #d3d3d3; font-size:14px}
.fancy form{padding:10px}
.fancy p{height:28px; line-height:28px; padding:4px; color:#999}
.input{height:20px; line-height:20px; padding:2px; border:1px solid #d3d3d3; width:100px}
.btn{-webkit-border-radius: 3px;-moz-border-radius:3px;padding:5px 12px; cursor:pointer}
.btn_ok{background: #360;border: 1px solid #390;color:#fff}
.btn_cancel{background:#f0f0f0;border: 1px solid #d3d3d3; color:#666 }
.btn_del{background:#f90;border: 1px solid #f80; color:#fff }
.sub_btn{height:32px; line-height:32px; padding-top:6px; border-top:1px solid #f0f0f0; text-align:right; position:relative}
.sub_btn .del{position:absolute; left:2px}

/*room_title*/
.room_title{}
.room_title li{width: 14%; float: left; text-align: center; padding-top: 10px;}
}

</style>
<script src='http://code.jquery.com/jquery-1.9.1.js'></script>
<script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

<script src='js/fullcalendar.min.js'></script>
<script src='js/jquery.fancybox-1.3.1.pack.js'></script>
<script type="text/javascript" src="js/creatcalendar.js"></script>
<script type="text/javascript">

function GoToToday(){
    location.reload();
}

function GoToPrev(){
    $('#month').fullCalendar("prev");
}

function GoToNext(){
    $('#month').fullCalendar("next");
}

</script>
</head>

<body>
<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">会议室预定</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="brand"><?php echo RealName() . ",你好! 今天是 " . date("Y.m.d-l"); ?></li>
                            <li class="active">
                                <a href="logout.php" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>注销<i class="caret"></i>

                                </a>
                     
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="">
                                <a href="month.php">月</a>
                            </li>
                            <li class="">
                                <a href="week.php">周</a>
                            </li>
                            <li class="active">
                                <a href="today.php">日</a>
                            </li>
                            <li>
                                <a id="data_title"></a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

<div class="container-fluid">
            <div class="row-fluid">
                <div style="position: fixed; width: 16%; float: right; padding-top: 0; padding-left: 2%;">
                    <!--<div style="z-index: 999;">
                        <button class="button" type="button" onclick="GoToPrev()"><<</button><button class="button" type="button" onclick="GoToNext()">>></button><button class="button" type="button" onclick="GoToToday()">今天</button>
                        <button class="button" type="button" onclick="MonthView()">月</button><button class="button" type="button" onclick="WeekView()">周</button><button class="button" type="button" onclick="window.location.href='today.html'">日</button>
                    </div>-->
                    <div id="month" style="width: 100%; float: right; margin-top: 10px; margin-right: 5%;"></div>
                    <!--<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse" style="float: right;">
                        <li>
                            <a href="month.php?room=">125会议室</a>
                        </li>
                        <li>
                            <a href="month.php?room=2">第三报告厅</a>
                        </li>
                        <li>
                            <a href="month.php?room=3">二号楼328会议室</a>
                        </li>
                        <li>
                            <a href="month.php?room=4">二楼报告厅</a>
                        </li>
                        <li>
                            <a href="month.php?room=5">四楼会议室</a>
                        </li>
                        <li>
                            <a href="month.php?room=6">四楼小会议室</a>
                        </li>
                        <li>
                            <a href="month.php?room=7">四楼休闲厅</a>
                        </li>
                    </ul>-->
                </div>
                <!--/span-->
                <div class="span9" id="content" style="float: right; margin: 0 5%;">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="datetitle" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                    <ul class="room_title">
                                        <li>
                                            <a id="title" href="week.php?room=">125会议室</a>
                                        </li>
                                        <li>
                                            <a id="title2" href="week.php?room=2">第三报告厅</a>
                                        </li>
                                        <li>
                                            <a id="title3" href="week.php?room=3">二号楼328会议室</a>
                                        </li>
                                        <li>
                                            <a id="title4" href="week.php?room=4">二楼报告厅</a>
                                        </li>
                                        <li>
                                            <a id="title5" href="week.php?room=5">四楼会议室</a>
                                        </li>
                                        <li>
                                            <a id="title6" href="week.php?room=6">四楼小会议室</a>
                                        </li>
                                        <li>
                                            <a id="title7" href="week.php?room=7">四楼休闲厅</a>
                                        </li>
                                    </ul>
                                    <div style="width: 100%; float: left;">
                                        <div id='calendar' style="width: 14%; float: left;"></div>
                                        <div id='calendar2' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                        <div id='calendar3' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                        <div id='calendar4' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                        <div id='calendar5' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                        <div id='calendar6' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                        <div id='calendar7' style="width: 14%; float: left; margin: 20px auto 10px auto;"></div>
                                    </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p style="text-align:center;">&copy; Vincent Gabriel 2013 - More Templates </p>
            </footer>
        </div>

<p id="stat"><script type="text/javascript" src="/js/tongji.js"></script></p>
<script type="text/javascript">
    CreatCalendar();
    CreatCalendar(2);
    CreatCalendar(3);
    CreatCalendar(4);
    CreatCalendar(5);
    CreatCalendar(6);
    CreatCalendar(7);
</script>
</body>
</html>
