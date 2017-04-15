<?php
namespace Home\Controller;
use Think\Controller;
Header("Content-Type:text/html;charset=utf-8");
class ExamController extends Controller {
	public function exam(){
    	if(empty($_POST)){
            if(!session('?id')){
                echo "<script>alert('请登录！');window.location.href='".U('User/login')."';</script>";
            }else{
                $this -> id = session('id');
                $this -> name = session('name');
            }
    		$this -> display();
    	}else{
    		echo '已获取到值！';
    	}
    }

	public function exampaper_paper(){
    	if(empty($_POST)){
    		$model = M('question_bank');
			/*单选题*/
			$id0 = $model -> where('qbtype = 0') ->field('qbid') -> select(); //获取表中有几条数据
			$rand0 = array_rand($id0,2);  //获取3条数据的下标
			$dxs = array();
			foreach($rand0 as $v){
				foreach($id0[$v] as $val){
					$dx[] = $model 
						  -> where(array('qbid' => $val))
						  -> field('qbid,qbname,qbbeixuan')
						  -> select();	
				}
			}
			$this -> assign('dx',$dx);
			/*判断题*/
			$id2 = $model -> where('qbtype = 2') ->field('qbid') -> select(); //获取表中有几条数据
			$rand2 = array_rand($id2,2);  //获取3条数据的下标
			$pd = array();
			foreach($rand2 as $v){
				foreach($id2[$v] as $val){
					$pd[] = $model 
						  -> where(array('qbid' => $val))
						  -> field('qbname,qbid,qbbeixuan')
						  -> select();	
				}	
			}
			$this -> assign('pd',$pd);
//			/*问答题*/
			$id3 = $model -> where('qbtype = 3') ->field('qbid') -> select(); //获取表中有几条数据
			$rand3 = array_rand($id3,2);  //获取3条数据的下标
			$wd = array();
			foreach($rand3 as $v){
				foreach($id3[$v] as $val){
					$wd[] = $model 
						  -> where(array('qbid' => $val))
						  -> field('qbname,qbid')
						  -> select();	
				}	
			}
			$this -> assign('wd',$wd);
//			/*填空题*/
			$id4 = $model -> where('qbtype = 4') ->field('qbid') -> select(); //获取表中有几条数据
			$rand4 = array_rand($id4,2);  //获取3条数据的下标
			$tk = array();
			foreach($rand4 as $v){
				foreach($id4[$v] as $val){
					$tk[] = $model 
						  -> where(array('qbid' => $val))
						  -> field('qbname,qbid')
						  -> select();	
				}	
			}
			$this -> assign('tk',$tk);
    		$this -> name = session("name");
    		$this -> id = session('id');
    		$this -> display();
    	}else{
    		$data = I('post.');
			$model = M('score'); 
			$date = date('Y-m-d '); //获取
			$user = session('id'); //获取
			$grade = 1;
			$dataList = array();
			$list = array();
			$scoreId=M('score')->max('scoreid');
			foreach($data as $key => $val){
				$list['scoreid'] = $scoreId+1;
				$list['qbid'] = $key;
				$list['scoreanswer'] =$val;
//				$list['id'] = $user;
				$list['scoredate'] = $date;
				$list['scoregrade'] = $grade;
				$dataList[] = $list;
			}
			$dxadd = $model ->addAll($dataList);
			if($dxadd){
				$models = M('reportcard');
                $models -> add(array('userid'=> $user,'scoreid' => $scoreId,'date'=> $date));
				echo "<script>window.location.href='".U('Index/index')."';</script>";
			}else{
				echo '失败';
			}
    	}
    }
	public function scores(){
    	if(empty($_POST)){
            if(!session('?id')){
                echo "<script>alert('请登录！');window.location.href='".U('User/login')."';</script>";
            }else{
                $this -> id = session('id');
                $this -> name = session('name');
            }
			$model = M('reportcard');
			$user = session('id'); //获取
			$count = $model -> count();
			$Page = new \Think\Page($count,10);
			$show = $Page->show();
			$sel = $model
				 -> alias('a')
				 -> where("a.userid=$user")
				 -> join('LEFT JOIN lamp_user_business b on a.userid=b.id')
				 -> order('a.totalscore desc')
				 -> field('b.name,a.totalscore,a.date')
				 -> limit($Page -> firstRow.','.$Page -> listRows)
				 -> select();
			$this -> assign('first',$Page -> firstRow);
			$this -> assign('sel',$sel);
			$this -> assign('page',$show);	
			$this -> name = session("name");
    		$this -> display();
    	}else{
    		echo '已获取到值！';
    	}
    }
	public function lesson_index(){
			$model = M('class');
			if(empty($_POST)){
				$list = $model -> where('classnumber = 1') -> select();
				$this -> assign('list',$list);
				$list1 = $model -> where('classnumber = 2') -> select();
				$this -> assign('list1',$list1);
				$list2 = $model -> where('classnumber = 3') -> select();
				$this -> assign('list2',$list2);
			}else{
				echo '获取到值！';
			}
		$this -> id = session("id");
		$this -> name = session("name");
		$this -> display();
    }
	public function lesson_right(){
		if(empty($_POST)){
			
		}else{
			echo '获取到值！';
		}
		$this -> display();
	}
	public function lesson_right1(){
		$model = M('files');
		if(empty($_POST)){
			$cls = I('get.id');
			$con = $model -> count();
			$Page = new \Think\Page($con,10);
			$show = $Page -> show();
			$list = $model
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  -> field('a.*,b.id,b.name')
				  -> where(array('pid' => $cls,'ftype' => 0))
				  -> limit($Page -> firstRow.','.$Page -> listRow)
				  -> select();
			$this -> assign('first');
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			
		}else{
			echo '获取到值';
		}
		$this -> display();
	}
	public function lesson_right2(){
		$model = M('files');
		if(empty($_POST)){
			$cls = I('get.id');
			$con = $model -> count();
			$Page = new \Think\Page($con,10);
			$show = $Page -> show();
			$list = $model
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  -> field('a.*,b.id,b.name')
				  -> where(array('pid' => $cls,'ftype' => 1))
				  -> limit($Page -> firstRow.','.$Page -> listRow)
				  -> select();
			$this -> assign('first');
			$this -> assign('list',$list);
			$this -> assign('page',$show);
		}else{
			echo '获取到值';
		}
		$this -> display();
	}
	public function lesson_right3(){
		$model = M('files');
		if(empty($_POST)){
			$cls = I('get.id');
			$con = $model -> count();
			$Page = new \Think\Page($con,10);
			$show = $Page -> show();
			$list = $model
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
				  -> field('a.*,b.id,b.name')
				  -> where(array('pid' => $cls,'ftype' => 2))
				  -> limit($Page -> firstRow.','.$Page -> listRow)
				  -> select();
			$this -> assign('first');
			$this -> assign('list',$list);
			$this -> assign('page',$show);
		}else{
			echo '获取到值';
		}
		$this -> display();
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
}