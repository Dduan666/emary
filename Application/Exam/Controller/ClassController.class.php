<?php
namespace Exam\Controller;
use Think\Controller;
class ClassController extends Controller {
    public function index(){
    	if(empty($_POST)){
            $this -> id = session('id');
            $this -> name = session('name');
            $this -> rank = session('rank');
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
	public function category(){
		$model = M('class');
    	if(empty($_POST)){
    		$count = $model -> count();
			$Page = new \Think\Page($count,10);
			$show = $Page -> show();
			$list = $model 
				  -> limit($Page -> firstRow.','.$Page -> listRows) 
				  -> order(['pid asc','id asc'])
				  -> select();
			$arr = array('显示','隐藏');
			foreach($list as $key => $val){
				$list[$key]['classgrade'] = $arr[$val['classgrade']];
			}
			$this -> assign('first');
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		$id = I('post.id');
			$del = $model -> where("id = $id") -> delete();
			if($del == true){
				echo 1;
			}else{
				echo 2;
			}
    	}
    }
	public function category_add(){
		$model = M('class');
		$data = I("post.");
		if(empty($_POST)){
			$sel = $model -> select();
			$this -> assign('classInfo',$sel);
			$this -> rank = session('rank');
			$this -> display();
		}else{
			$cla = $model
				-> add(array(
						'pid' => $data['classParent'],
						'classname' => $data['className'],
						'classgrade' => $data['classGrade'],
						'classintro' => $data['classIntro'],
						'classnumber' => $data['classNumber']));
			if($cla){
				echo "<script>
				window.location.href='".U('Class/category_add')."';
				</script>";
			}else{
				echo '失败！';
			}
		}
	}
	public function category_adds(){
		$model = M('class');
		$data = I("post.");
		if(empty($_POST)){
			$id = I("get.id");
			$sel = $model -> where("id = $id") -> select();
			$this -> assign('sel',$sel);
			$this -> rank = session('rank');
			$this -> display();
		}else{
			$cla = $model
				-> add(array(
						'pid' => $data['classParent'],
						'classname' => $data['className'],
						'classgrade' => $data['classGrade'],
						'classintro' => $data['classIntro'],
						'classnumber' => $data['classNumber']));
			if($cla){
				echo "<script>
				window.location.href='".U('Class/category')."';
				</script>";
			}else{
				echo "<script>alert('失败！');</script>";
			}
		}
	}
	public function category_alter(){
		$model = M('class');
		if(!IS_POST){
			$id = I('get.id');
			$sel = $model -> field('id,classname') ->select();
			$list = $model -> where("id = $id") -> find();
			$this -> assign('sel',$sel);
			$this -> assign('list',$list);
			$this -> assign('sid',$id);
			$this -> rank = session('rank');
			$this -> display();
		}else{
			$data = I('post.');
			$in=array(  'pid' => $data['classParent'],
						'classname' => $data['className'],
						'classgrade' => $data['classGrade'],
						'classnumber' => $data['classNumber'],
						'classintro' => $data['classIntro']
					);
			$sa = $model 
				-> where("id =".$data['ids'])
				-> save($in);
			if($sa !== false){
				echo "<script>
				window.location.href='".U('Class/category')."';
				</script>";
			}else{
				echo "<script>alert('失败！');</script>";
			}
		}
	}
	public function test(){
//		$id = I('get.id');
		$data = M('post.');
		print_r($data);
	}
	public function content(){
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
}