<?php
namespace Exam\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	if(empty($_POST)){
    		$this -> name = session('name');
    		$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	public function user(){
    	if(empty($_POST)){
    		$id = session('id');
    		$model = M('user_business');
    		$count = $model->count(); 
			$Page = new \Think\Page($count,10); 
			$show = $Page->show();
			$a = $model
			   -> limit($Page -> firstRow.','.$Page -> listRows)
			   -> order('id desc')
			   -> select();
			$grade = array('1' => '业务','2' => '风控','3' => '超级管理员');
			foreach($a as $key => $val){
				$a[$key]['rank'] = $grade[$val['rank']];
			}
			$this -> assign('info',$a);
			$this -> assign('page',$show);
            $this -> name = session('name');
            $this -> rank = session('rank');
    		$this -> display();
    	}else{
    		echo '获取到值？';
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
					if($a['rank'] > 1){
						$token=md5(time());
						$data['token'] = $token;
						$update = $model->where("id = ".$a['id'])->save($data);
						if($update == 1){
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
    		$this -> grade = session('rank');
    		$this -> name = session('name');
    		$this -> display(); 
    	}else{
    		$data = I("post.");
			$model = M("user_business");
			if(!empty($data['user']) && !empty($data['pass']) && !empty($data['grade']) && !empty($data['pass1'])){
				$repeat = $model -> where(array('name' => $data['user'])) ->count();
				if($repeat == 0){
					if($data['pass'] === $data['pass1']){
						$password =md5($data['pass']);
						$ip = get_client_ip();
						$date = date('Y-m-d');
						$adds = $model
							  -> add(array(
							  		'name' => $data['user'],
							  		'password' => $password,
							  		'rank' => $data['grade'],
									'lasttime' => $date));
						if($adds){
							echo 4;
						}else{
							echo 3;
						}               
					}else{
						echo 2;
					}
				}else{
					echo 1;
				}
			}else{
				echo 0;
			}
    	}
    }
	public function user_alter(){
		$id = I("get.id");
		$model = M("user_business");
    	if(empty($_POST)){
//  		$id = I('get.id');
			$shows = $model -> where("id =$id") ->find();
			$this ->assign('info',$shows);
			$this -> grade = session('rank');
    		$this -> display();
    	}else{
    		$data = I('post.');
			$save = $model 
			      -> where("id = $id")
				  ->save(array(
			    			'name' => $data['user'],
			    			'rank' => $data['grade']));
				  if($save !== false){
				  	echo 2;
				  }else{
				  	echo 3;
				  }
    	}
    }
	public function user_del(){
    	$id = I('post.id');
		$model = M('user_business');
		$del = $model -> where("id = $id") -> delete();
		if($del == true){
			echo 1;
		}else{
			echo 2;
		}
    }
	public function actor(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	public function addactor(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	public function module(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	public function addmodule(){
    	if(empty($_POST)){
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	
}