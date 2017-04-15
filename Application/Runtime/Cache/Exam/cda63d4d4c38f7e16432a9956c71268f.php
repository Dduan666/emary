<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="/Publicle-mobile-web-/Public-capable" content="yes" />
    <title>文件列表</title>
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

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<ul class="nav nav-tabs nav-stacked">
				<li class="active"><a href="/exam/file/attachs">文件管理</a></li>
			</ul>
		</div>
		<div class="span10" id="datacontent">
			<ul class="breadcrumb">
				<li><a href="index.php?exam-master">文件模块</a> <span class="divider">/</span></li>
				<li>文件管理</li>
			</ul>
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">文件管理</a>
				</li>
				<li class="dropdown pull-right">
					<a href="/exam/file/attachs_add" class="dropdown-toggle" >添加文件</a>
				</li>
			</ul>
			<form action="" method="post">
				<fieldset>
					<table class="table table-hover">
			            <thead>
			                <tr>
			                    <th width="2%"><input type="checkbox" class="checkall" target="delids"/></th>
			                    <th width="5%">ID</th>
						        <th>文件名</th>
						        <th>文件类型</th>
						        <th width="40%">文件路径</th>
						        <th>录入人</th>
						        <th>录入时间</th>
						        <th>操作</th>
			                </tr>
			            </thead>
			            <tbody  class="nums">
			            	<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
								<td><input type="checkbox" class="pldel" name="qbid_<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>"></td>
								<td><?php echo ($vo["id"]); ?></td>									
								<td><?php echo ($vo["fname"]); ?></td>
								<td><?php echo ($vo["filetype"]); ?></td>
								<td><?php echo ($vo["fileurl"]); ?></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ($vo["filetime"]); ?></td>
								<td>
									<div class="btn-group">
			                    		<a class="btn" href="/exam/file/attachs_alter/id/<?php echo ($vo["id"]); ?>" title="修改"><em class="icon-edit"></em></a>
										<a class="btn" onclick="del(<?php echo ($vo["id"]); ?>)" class="del" ><em class="icon-remove"></em></a>
			                    	</div>
								</td>
					       </tr><?php endforeach; endif; ?>
					    </tbody>
			        </table>
			        <div class="control-group">
			            <div class="controls">
				            <button id="dels" class="btn btn-primary" type="button">删除</button>
				        </div>
			        </div>
			        <div class="pagination pagination-right">
			        	<div id="page"><?php echo ($page); ?></div>
			        </div>
		        </fieldset>
			</form>
		</div>
	</div>
</div>


</body>
</html>

<script>
	function del(id){
		$.ajax({
			type : 'post',
			url  : '',
			dataType : 'json',
			data : {id: id},
			success:function(data){
				if(data == 1){
					alert('删除成功');
					window.location.reload();
				}else{
					alert('删除失败');
				}
			}
		});
	}
</script>
<script>
	$(function(){
		$('#dels').click(function(){
			if(confirm('确定要删除吗？') == true){
				var arr = [];
				var ids = $(".nums input[type='checkbox']:checked");
				for(var i = 0;i < ids.length;i++){
					arr+=$(ids[i]).val()+",";
				}
				if(arr ==''){
					alert('请至少选择一项！');
				}else{
					arr = arr.substring(0,arr.length-1);
					$.ajax({
						type : 'post',
						url  : '/exam/file/attachs_dels',
						dataType : 'json',
						data : {ids: arr},
						success:function(data){
							if(data == 0){
								window. location.reload();
							}else{
								alert('请稍后再试！');
							}
						}
					});
				}
			}else{return false;}				
		});
	});
</script>