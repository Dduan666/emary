<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function index(){
    	if(empty($_POST)){
    		$this -> name = session('name');
    		$this -> id = session('id');
    		$this -> display();
    	}
    }
    public function login(){
    	if(empty($_POST)){
    		
    		$this -> display();
    	}else{
    		$data = I("post.");
			if(empty($data['user']) || empty($data['pass'])){
				echo 1; //用户名和密码不能为空！
			}else{
				$model = M('user_business');
				$b = md5($data['pass']);
				$a = $model-> where(array('name' => $data['user'])) -> field('id,name,rank,password') -> find();
				if($a['password'] == $b){
					if($a['rank']==1){
						$token=md5(time());
						$data['token'] = $token;
						$update = $model->where("id = ".$a['id'])->save($data);
						if($update==1){
							session('token',$token);
						}
						session("id",$a['id']);
						session("name",$a['name']);
						session("rank",$a['rank']);
						echo 2;
					}else{
						echo 4;
					}
				}else{
					echo 3;
				}	
			}
    	}                   
    }
	public function register(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		$data = I('post.');
			$model = M('user');
			if(empty($data['user']) || empty($data['email']) || empty($data['pass'])){
				echo 1; //判断信息不能为空
			}else{
				$repeat = $model -> where(array('username' => $data['user'])) -> count();
				if($repeat > 0){
					echo 2; //判断用户名是否从复
				}else{
					if($data['pass'] !== $data['passw']){
						echo 3; //判断两次输入的密码是否一致
					}else{
						$b = get_client_ip(); //获取客户端当前的IP地址
						$c = date('Y-m-d');	  //获取客户注册的时间
						$a = $model -> add(array('username' => $data['user'],'useremail' => $data['email'],'userpassword' => md5($data['pass']),'userregip' => $b));
						if($a){
							echo 4; //判断用户是否注册成功
						}else{
							echo 5;
						}
					}
				}
			}				
		}
    }
    public function modifyuser(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '已获取到值！';
    	}
    }
	public function payfor(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '已获取到值！';
    	}
    }
}