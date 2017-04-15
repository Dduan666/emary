<?php
namespace Exam\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$data = I('get.');
		$id = $data['id'];
		if(session('id') || session('token')){
			$this->display();
		}else{
			$list = M("user_business") -> where("id = $id") -> field('id,name,token') -> find();
			if($list['token'] !== $data['token']){
				echo "<script>alert('请登录！');window.location.href='".U('User/login')."';</script>";
				return false;
			}else{
				session('id',$list['id']);
				session('name',$list['name']);
				session('token',$list['token']);
				$this->assign(session());
				$this ->display();
			}
		}
    }
	public function logout(){
		$ses = session();
		if(!empty($ses)){
//			session_start(); //销毁全部session
			session('id,name,rank,token',null);
//			unset($_SESSION['userpassword']); //销毁一条session数据
			echo 1;
		}else{
			echo 2;
		}
	}
}