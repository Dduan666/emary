<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examry</title>
    <!--<link href="/Public/core/styles/css/bootstrap.css" rel="stylesheet">-->
<!--<link href="/Public/core/styles/css/bootstrap-responsive.css" rel="stylesheet">-->
<!--<link href="/Public/core/styles/css/plugin.css" rel="stylesheet">-->
<!--<link href="/Public/user/styles/css/theme.css" rel="stylesheet" type="text/css" />-->
<!--<link href="/Public/core/styles/css/datetimepicker.css" rel="stylesheet">-->
<!--<link rel="stylesheet" href="/Public/exam/styles/css/mathquill.css" type="text/css">-->
<!--<link href="/Public/core/styles/banner/css/banner.css" rel="stylesheet"/>-->
<!--<script type="text/javascript" src=""></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/jquery-1.9.1.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/jquery-ui.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/jquery.json.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/bootstrap.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/bootstrap-datetimepicker.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/ckeditor/ckeditor.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/swfu/swfupload.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/plugin.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/unslider.min.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/highcharts.js"></script>-->
<!--<script type="text/javascript" src="/Public/core/styles/js/logouts.js"></script>-->


<link href="/Public/core/styles/css/page.css" rel="stylesheet">
<link href="/Public/core/styles/css/bootstrap.css" rel="stylesheet">
<link href="/Public/core/styles/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/Public/core/styles/css/plugin.css" rel="stylesheet">
<link href="/Public/user/styles/css/theme.css" rel="stylesheet" type="text/css" />
<link href="/Public/core/styles/css/datetimepicker.css" rel="stylesheet">
<script type="text/javascript" src="/Public/core/styles/js/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="/Public/exam/styles/css/mathquill.css" type="text/css">
<script type="text/javascript" src="/Public/core/styles/js/jquery-ui.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/jquery.json.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/swfu/swfupload.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/core/styles/css/SimpleTree.css"/>
<!-- <script type="text/javascript" src="/Public/core/styles/js/jquery-1.6.min.js"></script> -->
<script type="text/javascript" src="/Public/core/styles/js/SimpleTree.js"></script>
<script src="/Public/exam/styles/js/plugin.js"></script>
</head>
<body>
<div class="row-fluid topLine">
    <div class="container-fluid">
        <div class="span4"></div>
        <div class="span8">
			<span class="pull-right">
				<?php if($Think['session']['id']): ?>您好：<a href="/home/User/login">请登录</a>
				<?php else: ?>
					您好：<a href="#"><?php echo (session('name')); ?></a>&nbsp;&nbsp;&nbsp;<?php endif; ?>
				<a href="/home/User/index" data-toggle="dropdown">
				<em class="icon-user"></em> 用户中心</a>&nbsp;&nbsp;&nbsp;
				<a href="" data-toggle="dropdown" id="logout"><em class="icon-lock"></em> 退出</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</span>
        </div>
    </div>
</div>
<div class="row-fluid top">
    <div class="container-fluid">
        <div class="span4"><a name="top"></a><h2><img width="194" height="74" src="/Public/user/styles/img/theme/log.png" /></h2></div>
        <div class="span8">
            <div class="navbar" id="menuNav">
                <div class="">
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="active mainmenu">
                                <a href="http://web.zhuoyijinrong.com">主页</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#logout').click(function(){
            var msg = '确定要退出吗？';
            if(confirm(msg) == true){
                $.ajax({
                    type : 'post',
                    url  : '/home/Index/logout',
                    datatype : 'json',
                    success:function(data){
                        if(data == 1){
                            window.location.href = "/home/User/login";
                        }else{
                            alert('你好，请登录！');
                            window.location.href = "/home/User/login";
                        }
                    }
                });
            }else{
                alert('失败！');
            }
        });
    });
</script>
<div class="row-fluid">
    <div class="container-fluid examcontent">
        <div class="exambox" id="datacontent">
            <div class="examform">
                <ul class="breadcrumb">
                    <li>
                        <span class="icon-home"></span>主页
                    </li>
                </ul>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#" data-toggle="tab">考试 学习</a>
                    </li>
                </ul>
                <ul class="thumbnails">
                    <li class="span2">
                        <div class="thumbnail">
                            <img src="/Public/core/styles/images/icons/Watches.png"/>
                            <div class="caption">
                                <p class="text-center">
                                    <a class="btn btn-primary" href="/home/Exam/exam">正式考试</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="span2">
                        <div class="thumbnail">
                            <img src="/Public/core/styles/images/icons/Retina-Ready.png"/>
                            <div class="caption">
                                <p class="text-center">
                                    <a class="btn btn-primary" href="/home/Exam/scores">成绩单</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="span2">
                        <div class="thumbnail">
                            <img src="/Public/core/styles/images/icons/Book.png"/>
                            <div class="caption">
                                <p class="text-center">
                                    <a class="btn btn-primary" href="/home/Exam/lesson_index">在线培训</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="span2">
                        <div class="thumbnail">
                            <img src="/Public/core/styles/images/icons/Clipboard.png"/>
                            <div class="caption">
                                <p class="text-center">
                                    <a class="btn btn-primary" href="/home/Simulate/simulate_index">模拟考试</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid">
    <div class="container-fluid logfooter">
        <ul class="inline unstyled">
            <li><a href="">网站首页</a></li>
            <li>|</li>
            <li><a href="">用户须知</a></li>
            <li>|</li>
            <li><a href="">隐私协议</a></li>
            <li>|</li>
            <li><a href="">网站论坛</a></li>
            <li>|</li>
            <li>豫ICP备13016752号-1</li>
        </ul>
    </div>
</div>
</body>
</html>