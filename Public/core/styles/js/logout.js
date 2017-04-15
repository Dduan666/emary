	$(function(){
		$('#logout').click(function(){
			var msg = '确定要退出吗？';
			if(confirm(msg) == true){
				$.ajax({
					type : 'post',
					url  : '__MODULE__/Index/logout',
					datatype : 'json',
					success:function(data){
						if(data == 1){
							window.location.href = "__MODULE__/User/login";
						}else{
							alert('你好，请登录！');
							window.location.href = "__MODULE__/User/login";
						}
					}
				});
			}else{
				alert('失败！');
			}
		});
	});
