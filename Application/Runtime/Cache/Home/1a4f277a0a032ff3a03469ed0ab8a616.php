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


	<body style="background: none!important;">
<div class="row-fluid">
	<table class="table table-bordered table-hover">
		<tr class="info">
			<td width="10%">序号</td>
			<td width="15">录入人</td>
			<td width="35%">资料名称</td>
            <td width="20%">文件类型</td>
			<td width="20%">下载</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($first+$key+1); ?></td>
				<td><?php echo ($vo["username"]); ?></td>
				<td><?php echo ($vo["name"]); ?></td>
				<td><?php echo ($vo["filetype"]); ?></td>
				<td>
					<div class="btn-group">
						<a class="btn" href="/home/file_download/id/<?php echo ($vo["id"]); ?>" title="下载"><em class="icon-arrow-down"></em></a>
				    </div>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr>
			<td colspan="5"><div id="page"><?php echo ($page); ?></div></td>
		</tr>
	</table>
</div>
	</body>


</body>
</html>