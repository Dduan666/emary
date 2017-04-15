<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="/Publicle-mobile-web-/Public-capable" content="yes" />
    <title>添加文件</title>
    <!–[if lt IE9]>
<script src="/Public/core/styles/js/html5.js"></script>
<![endif]–>
<!-- Le styles -->
<link href="/Public/core/styles/css/bootstrap-combined.min.css" rel="stylesheet">
<link href="/Public/core/styles/css/layoutit.css" rel="stylesheet">
<link href="/Public/core/styles/css/plugin.css" rel="stylesheet">
<link href="/Public/core/styles/css/datetimepicker.css" rel="stylesheet">
<link href="/Public/core/styles/css/page.css" rel="stylesheet">
<script type="text/javascript" src="/Public/core/styles/js/jquery.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/Public/core/styles/js/html5shiv.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/jquery-1.9.1.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/Public/core/styles/js/jquery-ui.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/Public/core/styles/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/swfu/swfupload.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/plugin.js"></script>
<script type="text/javascript" src="/Public/core/styles/js/logout.js"></script>
    <style>table td{border: none!important;}</style>
</head>
<body>

<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a href="/Exam/Index/index" target="_parent" class="brand"><img src="/Public/core/styles/images/favicon.png">卓屹考试系统管理平台<span class="label"></span></a>
            <div class="nav-collapse navbar-responsive-collapse collapse">
                <ul class="nav">
                    <li><a href="/Exam/Index/index">全局</a></li>
                    <?php if(session('rank') > 2): ?><li><a href="/Exam/User/index">用户模块</a></li><?php endif; ?>
                    <li><a href="/Exam/Exam/index">考试模块</a></li>
                    <li><a href="/Exam/File/index">文件模块</a></li>
                    <li><a href="/Exam/Class/index">内容模块</a></li>
                    <li><a href="/Exam/Assess/index">考核模块</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo (session('name')); ?><strong class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li><a href="" data-toggle="dropdown" id="logout">退出管理</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

	<body>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span2">
					<div class="accordion" id="accordion-13465">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="/exam/file/attachs">文件管理 </a>
							</div>
						</div>
					</div>
				</div>
				<div class="span10" id="datacontent">
					<ul class="breadcrumb">
						<li><a href="">文件模块</a> <span class="divider">/</span></li>
						<li>文件管理</li>
						<li class="active">添加文件</li>	
					</ul>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#">添加文件</a></li>
						<li class="pull-right"><a href="/exam/file/attachs">文件管理</a></li>
					</ul>
					<form action="/exam/file/fileupload" name="fileupload" method="POST" class="form-horizontal" enctype="multipart/form-data">
						<fieldset>
							<table class="table">
								<tr>
									<td width="10%">所属级别：</td>
						        	<td width="90%">
						        		<select name="classid" id="classid" class="input-medium">
						        			<option>请选择...</option>
									  		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo (htmlspecialchars_decode($vo["classname"])); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									  	</select>
									  	<select name="ftype" id="ftype" class="input-medium">
									  		<option>请选择...</option>
									  		<option value="0">文档</option>
									  		<option value="1">视频</option>
									  		<option value="2">录音</option>
									  	</select>
						        	</td>
								</tr>
								<tr>
									<td width="10%">多选项：</td>
									<td width="90%">
										<button class="btn" type="button" id="adds">增加</button>
										<button class="btn" type="button" id="dels">删除</button>
									</td>
								</tr>
								<tr class="addclass">
									<td width="10%">请选择：</td>
									<td width="90%">
										<input type="file" class="upload" name="filename[]" style="margin-top: 8px;" />
									</td>
								</tr>
							</table>
							<button class="btn btn-primary" type="submit" id="fileUpload">确定</button>
						</fieldset> 
					</form>
				</div>
			</div>
		</div>
	</body>


</body>
</html>

<script>
	$(function() {
		$('#logout').click(function() {
			$.ajax({
				type: 'post',
				url: '/exam/Index/logout',
				dataType: 'json',
				success: function(data) {
					if(data == 1) {
						window.location.href = "/exam/Login/login";
					} else {
						alert('系统错误');
						window.location.href = "javascript:window.opener=null;window.open('','_self');window.close();";
					}
				}
			});
		});
	});
</script>
<script>
	$(function(){
		$('#adds').click(function(){
			$('.table').append("<tr class='addclass'><td width='10%'></td><td width='90%'><input type='file' class='upload' name='filename[]' style='margin-top: 8px;' /></td></tr>");
		});
		$('#dels').click(function(){
			var con = $('.addclass').length;
			if(con > 1){
				$('.table .addclass:last').remove();
			}
		});
	});
</script>