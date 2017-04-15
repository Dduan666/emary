<?php
namespace Exam\Controller;
use Think\Controller;
class AssessController extends Controller {
    public function index(){
        $this -> id = session('id');
        $this -> name = session('name');
        $this -> rank = session('rank');
        $this -> display();
    }
	public function assess_ques(){
		$model = M('user_business');
		$models = M('question_bank');
		$con = $models -> count();
		$Page = new \Think\Page($con,15);
		$show = $Page -> show();
		$sel = $model -> field('id,name') -> where('rank = 2') -> select();
		$this -> assign('sel',$sel);
		if(!I('get.')){
			$list = $models
				  -> alias('a')
				  ->join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  ->limit($Page -> firstRow.','.$Page -> listRow) 
				  ->select();
			$arr = array('0'=>'单选题','2'=>'判断题','3'=>'问答题','4'=>'填空题');
			foreach($list as $key => $val){
				$list[$key]['qbtype']=$arr[$val['qbtype']];
			}
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			$this -> assign('con',count($list));
		}else{
			$id = I('get.id');
			$stime = I('get.stime');
			$etime = I('get.etime');
			$where = [];
			if($id){
                array_push($where,[ 'a.userid' => $id] );
            }
            if ($stime){
                array_push($where,[ 'a.qbdate' => array("EGT",$stime)] );
            }
            if ($etime){
                array_push($where,[ 'a.qbdate' => array("ELT",$etime)] );
            }
			$con = $models -> count();
			$Page = new \Think\Page($con,15);
			$show = $Page -> show();
			if (1==1){
                $select = $models
                    -> alias('a')
                    -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
                    -> field('a.*,b.id,b.name')
                    -> where($where)
                    -> select();
            }
			$this -> assign('list',$select);
			$this -> assign('page',$show);
			$this -> assign('con',count($select));
			$this -> assign('ids',$id);
			$this -> assign('stime',$stime);
			$this -> assign('etime',$etime);
		}
		$this -> id = session('id');
		$this -> name = session('name');
		$this -> rank = session('rank');
		$this -> display();
	}
	public function assess_data(){
		$model = M('user_business');
		$models = M('files');
		$name = $model -> where('rank = 2') ->field('id,name') -> select();
		$this -> assign('names',$name);
		$con = $models -> count();
		$Page = new \Think\Page($con,15);
		$show = $Page -> show();
		if(!I('get.')){
			$list = $models
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  -> limit($Page -> firstRow.','.$Page -> listRow)
				  -> field('a.*,b.id,b.name')
				  -> select();
			$this -> assign('con',count($list));
			$this -> assign('list',$list);
			$this -> assign('page',$show);
		}else{
			$id = I('get.id');
			$stime = I('get.stime');
			$etime = I('get.etime');
			$where = [];
			$con = $models -> count();
			$Page = new \Think\Page($con,15);
			$show = $Page -> show();
            if($id){
                array_push($where,[ 'a.userid' => $id] );
            }
            if ($stime){
                array_push($where,[ 'a.filetime' => array("EGT",$stime)] );
            }
            if ($etime){
                array_push($where,[ 'a.filetime' => array("ELT",$etime)] );
            }
			if(1==1){
				$list = $models
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  -> field('a.*,b.id,b.name')
				  -> where($where)
				  -> select();
			}
			$this -> assign('con',count($list));
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			$this -> assign('ids',$id);
			$this -> assign('stime',$stime);
			$this -> assign('etime',$etime);
		}
		$this -> id = session('id');
		$this -> name = session('name');
		$this -> rank = session('rank');
		$this -> display();
	}
	public function assess_look(){
		if(I('get.id')){
			$idd = I('get.id');
			$model = M('question_bank');
			$sel = $model -> where("qbid = $idd") -> find();
			$this -> assign('sel',$sel);
			$this -> display();
		}else{
			echo '获取到值吗';
		}
	}
	public function file_download(){
		$model = M('files');
		$id = I('get.id');
		if(!empty($id)){
			$sel = $model -> where("id = $id") -> find();
			$file='./Public/'.$sel['fileurl'];
			if($sel){
				 if(!isset($file)||trim($file)==''){  
		            echo '500';  
		        }  
		        if(!file_exists($file)){ //检查文件是否存在  
		            echo '404';  
		        }else{
					$file_name=basename($file);
			        $file_type=explode('.',$file);  
			        $file_type=$file_type[count($file_type)-1];  
			        $file_name=trim($sel['name']);
			        $file_type=fopen($file,'r'); //打开文件  
					header("Content-type: application/octet-stream"); 
					header('Content-type:text/html;charset=utf-8');
			        header("Accept-Ranges: bytes");  
			        header("Accept-Length: ".filesize($file));  
			        header("Content-Disposition: attachment; filename=".$file_name); 
			      	echo fread($file_type,filesize($file));  
        			fclose($file_type);
					}
			}else{
				echo 'error';
			}
		}else{
			echo 'error';
		}
		
	}
	public function logout(){
		$ses = session();
		if(!empty($ses)){
//			session_start(); //销毁全部session
			session('username',null);
			session('userid',null);
//			unset($_SESSION['userpassword']); //销毁一条session数据
			echo 1;
		}else{
			echo 2;
		}
	}
	public function test(){
		$model = M('user');
		$models = M('question_bank');
		if(empty($_POST)){
			$user = $model -> where('usergrade = 2') -> select();
			$this -> assign('user',$user); //显示select中的user
			$list = $models 
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user b on a.userid = b.userid')
				  -> field('a.*,b.userid,b.username')
				  -> select();
			$this -> assign('list',$list);
			
			function cube($k,$v){

				echo 'k:'.$k;
				echo '<br/>';
				echo 'v:'.$v;
			}
			$name = "cube";
			$arr = array('phone','computer');
			func_get_args($name,$arr);
			
			
		}else{
			$userid = I('get.userid');
			$stime = I('get.stime');
			$etime = I('get.etime');

		}
		$this -> display();
	}
	
}