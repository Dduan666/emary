<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学习资料</title>
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

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2" style="margin-top: 20px;">
			<div class="exambox"  style="width: 170px;height: 590px;overflow: auto;overflow-x: hidden;">
				<div class="st_tree">
					<ul>
						<li><a>银行</a></li>
						<ul>
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="width: 100px!important;"><a href="javascript:void(0)"><?php echo ($vo["classname"]); ?></a></li>
							<ul>
								<li style="width: 80px!important;"><a href="/home/exam/lesson_right1/id/<?php echo ($vo["id"]); ?>" target="right">文档</a></li>
								<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_luy.gif) no-repeat;"><a href="/home/exam/lesson_right2/id/<?php echo ($vo["id"]); ?>" target="right">录音</a></li>
								<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_ship.gif) no-repeat;"><a href="/home/exam/lesson_right3/id/<?php echo ($vo["id"]); ?>" target="right">视频</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<li><a>机构</a></li>
						<ul>
							<?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li style="width: 100px!important;"><a href="javascript:void(0)"><?php echo ($vo1["classname"]); ?></a></li>
								<ul>
									<li style="width: 80px!important;"><a href="/home/exam/lesson_right1/id/<?php echo ($vo1["id"]); ?>" target="right">文档</a></li>
									<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_luy.gif) no-repeat;"><a href="/home/exam/lesson_right2/id/<?php echo ($vo1["id"]); ?>" target="right">录音</a></li>
									<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_ship.gif) no-repeat;"><a href="/home/exam/lesson_right3/id/<?php echo ($vo1["id"]); ?>" target="right">视频</a></li>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						
						<?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><li style="width: 100px!important;"><a href="javascript:void(0)"><?php echo ($vo2["classname"]); ?></a></li>
							<ul>
								<li style="width: 80px!important;"><a href="/home/exam/lesson_right1/id/<?php echo ($vo2["id"]); ?>" target="right">文档</a></li>
								<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_luy.gif) no-repeat;"><a href="/home/exam/lesson_right2/id/<?php echo ($vo2["id"]); ?>" target="right">录音</a></li>
								<li style="width: 80px!important;background: url(/Public/core/styles/css/imgs/st_ship.gif) no-repeat;"><a href="/home/exam/lesson_right3/id/<?php echo ($vo2["id"]); ?>" target="right">视频</a></li>
							</ul><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span10" id="datacontent" style="">
			<div class="container-fluid examcontent" style=''>
				<div class="exambox" id="datacontent">
					<div class="examform" style="height: 560px;">
						<iframe src='/home/exam/lesson_right' name="right" scrolling="yes" frameborder="0" marginheight="0" marginwidth="0" width="964" height="500">
					    </iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>

<script>
$(function(){
	$(".st_tree").SimpleTree({
		/* 可无视代码部分*/
		click:function(a){
			if(!$(a).attr("hasChild"));		
		}
	});
});
</script>
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