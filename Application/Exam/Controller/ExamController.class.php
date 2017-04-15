<?php
namespace Exam\Controller;
use Think\Controller;
class ExamController extends Controller {
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
	public function questions(){
		$id = session('id');
		$model = M('question_bank'); // 实例化User对象
	    $models = M('user_business');
		$count = $model->count(); /*数据分页的第一种方法*/
		$Page = new \Think\Page($count,10); /*实例化分页类 传入总记录数和每页显示的记录数(25)*/
		$show = $Page->show();// 分页显示输出
			/*进行分页数据查询 注意limit方法的参数要使用Page类的属性*/
		if(empty($_POST)){
			$quse = $model
				  -> alias('a')
			      -> join('left join lamp_user_business b on a.userid = b.id')  //联合查询让里面相等的等
			      -> join('left join lamp_class c on a.classid = c.id')
                  -> limit($Page -> firstRow.','.$Page -> listRows)
				  -> field('a.*,b.name,c.classname') //给两表别名，q.*查所有的，u.name 只查名字
				  -> order('qbid desc')
			      -> select();
		}else{
			$data = I("post.");
			if(!empty($data['user']) && empty($data['type'])){
				$ids = $models
					 -> field('id')
					 -> where(array('name' => $data['user']))
					 -> find();
				$quse = $model
				  	  -> alias('a')
					  -> join('left join lamp_user_business b on a.userid = b.id')
					  -> field('a.*,b.name')
					  -> order('qbid desc')
					  -> limit($Page -> firstRow.','.$Page -> listRows)
					  -> where("a.userid = $id")
					  -> select();
			}else if(!empty($data['type']) && empty($data['user'])){
				$quse = $model
					  -> alias('a')
				      -> join('left join lamp_user_business b on a.userid = b.id')  //联合查询让里面相等的等
				      -> limit($Page -> firstRow.','.$Page -> listRows)
					  -> field('a.*,b.name') //给两表别名，q.*查所有的，u.username 只查名字
					  -> order('qbid desc')
					  -> where(array('a.qbtype' => $data['type']))
				      -> select();
			}else if(!empty($data['user']) && !empty($data['type'])){
				$quse = $model
					  -> alias('a')
				      -> join('left join lamp_user_business b on a.userid = b.id')  //联合查询让里面相等的等
				      -> limit($Page -> firstRow.','.$Page -> listRows)
					  -> field('a.*,b.username') //给两表别名，q.*查所有的，u.username 只查名字
					  -> order('qbid desc')
					  -> where(array('a.userid' => $data['user'],'a.qbtype' => $data['type']))
				      -> select();
			}else{
				echo '1';
				return false;
			}
		}
		$state = array("单选题","多选题","判断题","问答题","填空题");
	    foreach ($quse as $k => $v) {
	        $quse[$k]['qbtype'] = $state[$v['qbtype']];
		}
		$this -> assign("first",$Page -> firstRow); /*习题序号！*/
		$this -> assign('Info',$quse);/*赋值数据集*/
		$this -> assign('page',$show);/*赋值分页输出*/
		$this -> rank = session('rank');
		$this -> name = session('name');
		$this -> display();
    }
    public function question_sel()
    {
        $sel = I('post.sel');
        $mode = M('class');
        $list = $mode -> where("classnumber = $sel") -> select();
        $this->ajaxReturn($list);
    }
    public function question_add(){
    	if(empty($_POST)){
    		$this -> name = session('name');
			$this -> grade = session('rank');
    		$this -> display();
    	}else{
    		$id = session('id');
			$data = I('post.');
			$model = M('question_bank');
			if($data['qbtype'] == 0){
				if(!empty($data['qbname']) && !empty($data['qbbeixuan']) && !empty($data['qbdanxuan'])){
					$a = $model
						->add(array(
								'classid' => $data['classid'],
								'userid' => $id,
								'qbtype' => $data['qbtype'],
								'qbname' => $data['qbname'],
								'qbdaan' => $data['qbdanxuan'],
								'qbbeixuan' => $data['qbbeixuan'],
								'qbjiexi' => $data['qbjiexi']));
					if($a){
						echo 2;
					}else{
						echo 3;
					}
				}else{
					echo 1;
				}
			}else if($data['qbtype'] == 2){
				if(!empty($data['qbname']) && !empty($data['qbbeixuan']) && !empty($data['qbpanduan'])){
					$a = $model
						->add(array(
							'classid' => $data['classid'],
							'userid' => $id,
							'qbtype' => $data['qbtype'],
							'qbname' => $data['qbname'],
							'qbdaan' => $data['qbpanduan'],
							'qbbeixuan' => $data['qbbeixuan'],
							'qbjiexi' => $data['qbjiexi']));
					if($a){
						echo 2;
					}else{
						echo 3;
					}
				}else{
					echo 1;
				}
			}else if($data['qbtype'] == 3){
				if(!empty($data['qbname']) && !empty($data['qbwenda'])){
					$a = $model
						->add(array(
								'classid' => $data['classid'],
								'userid' => $id,
								'qbtype' => $data['qbtype'],
								'qbname' => $data['qbname'],
								'qbdaan' => $data['qbwenda'],
								'qbjiexi' => $data['qbjiexi']));
					if($a){
						echo 2;
					}else{
						echo 3;
					}
				}else{
					echo 1;
				}
			}else{
				if(!empty($data['qbname']) && !empty($data['qbtiankong'])){
					$a = $model
						->add(array(
								'classid' => $data['classid'],
								'userid' => $id,
								'qbtype' => $data['qbtype'],
								'qbname' => $data['qbname'],
								'qbdaan' => $data['qbtiankong'],
								'qbjiexi' => $data['qbjiexi']));
					if($a){
						echo 2;
					}else{
						echo 3;
					}
				}else{
					echo 1;
				}
			}
    	}
    }
	public function question_alter(){
    	if(empty($_POST)){
    		$id = I('get.id');
			$model = M('question_bank');
			$d = $model
				-> where(array('qbid' => $id))
				-> find();
			$this -> assign('info',$d);
			$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		$id = I('get.id');
    		$data = I('post.');
			$model = M('question_bank');
			if($data['qbtype'] == 0){
				$a = $model
					-> where("qbid = $id")
					-> save(array(
				   			'qbtype' => $data['qbtype'],
				   			'qbname' => $data['qbname'],
				   			'qbdaan' => $data['qbdanxuan'],
				   			'qbbeixuan' => $data['qbbeixuan'],
				   			'qbjiexi' => $data['qbjiexi']));
				if(false !== $a){
					echo 2;
				}else{
					echo 3;
				}
			}else if($data['qbtype'] == 1){
				$a = $model
				   	-> where("qbid = $id")
				   	-> save(array(
				   			'qbtype' => $data['qbtype'],
				   			'qbname' => $data['qbname'],
				   			'qbbeixuan' => $data['qbbeixuan'],
				   			'qbdaan' => $data['qbduoxuan'],
				   			'qbjiexi' => $data['qbjiexi']));
				if(false !== $a){
					echo 2;
				}else{
					echo 3;
				}
			}else if($data['qbtype'] == 2){
				$a = $model
				   	-> where("qbid = $id")
				   	-> save(array(
				   			'qbtype' => $data['qbtype'],
				   			'qbname' => $data['qbname'],
				   			'qbdaan' => $data['qbpanduan'],
				   			'qbbeixuan' => $data['qbbeixuan'],
				   			'qbjiexi' => $data['qbjiexi']));
				if(false !== $a){
					echo 2;
				}else{
					echo 3;
				}
			}else if($data['qbtype'] == 3){
				$a = $model
				   	-> where("qbid = $id")
				   	-> save(array(
				   			'qbtype' => $data['qbtype'],
				   			'qbname' => $data['qbname'],
				   			'qbdaan' => $data['qbwenda'],
				   			'qbjiexi' => $data['qbjiexi']));
				if(false !== $a){
					echo 2;
				}else{
					echo 3;
				}
			}else{
				$a = $model
				   	-> where("qbid = $id")
				   	-> save(array(
				   			'userid' => $id,
				   			'qbtype' => $data['qbtype'],
						   	'qbname' => $data['qbname'],
						   	'qbdaan' => $data['qbtiankong'],
						   	'qbjiexi' => $data['qbjiexi']));
				if(false !== $a){
					echo 2;
				}else{
					echo 3;
				}
			}
    	}
    }
	public function question_del(){
    	$data = I("post.id");
		$model = M("question_bank");
		$del = $model
			->where("qbid = $data")
			->delete();
		if($del == true){
			echo 1;
		}else{
			echo 2;
		}
    }
	public function question_dels(){
    	$data = I('post.ids');
//		print_r($data);die();
		$model = M('question_bank');
		$dels = $model->delete($data);
		if($dels){
			echo 0;
		}else{
			echo 1;
		}
    }
	public function exams(){
    	if(empty($_POST)){
    		$model=M('reportcard');
			$count = $model -> count();
			$Page = new \Think\Page($count,10);
			$show = $Page->show();
			$report = $model
			->join('left join lamp_user_business on lamp_user_business.id=lamp_reportcard.userid')
			->limit($Page -> firstRow.','.$Page -> listRows)
                ->field('lamp_reportcard.*,lamp_user_business.name')
                ->where(array('lamp_reportcard.grade'=> 0))
			->order('lamp_reportcard.reportid desc')
			->select();
			$this -> assign('first',$Page -> firstRow);
			$this -> assign('info',$report);
			$this -> assign('page',$show);
			$this -> rank = session('rank');
    		$this -> display();
    	}
    }

	public function exaps_check(){
		if(empty($_POST)){
			return  false;
		}
		$score=0;
		$kid = I('post.');
		$model = M('score');
		$where =[];
		$wheres =[];
		$where['lamp_score.scoreid']=['eq',$kid['scoreid']];
		$where['lamp_question_bank.qbtype']=['in',['0']];
		$dx = $model ->join('LEFT JOIN lamp_question_bank on lamp_score.qbid= lamp_question_bank.qbid')
		->where($where)
		->select();
		$wheres['lamp_score.scoreid']=['eq',$kid['scoreid']];
		$wheres['lamp_question_bank.qbtype']=['in',['2']];
		$pd = $model ->join('LEFT JOIN lamp_question_bank on lamp_score.qbid= lamp_question_bank.qbid')
		->where($wheres)
		->select();
		foreach($pd as $vo){
			if($vo['lamp_scoreanswer']==$vo['lamp_qbdaan']){
				$score+=5;
			}
		}
		foreach($dx as $vo){
			if($vo['lamp_scoreanswer']==$vo['lamp_qbdaan']){
				$score+=5;
			}
		}
		foreach($kid as $key => $vo){
			$s =substr($key,0,strrpos($key,'_'));
			if($s=='tk' or $s=='wd'){
				$score+=$vo;
			}
		}
		$report =M('reportcard');
		$data['totalscore']=$score;
		$data['status']=1;
		$res=$report ->where("scoreid='".$kid['scoreid']."'")->save($data);
		echo "<script>window.close();self.opener.location.reload();</script>";
	//	$res=$report ->where(array('scoreid=' => $kid['scoreid']))->save($data);
	}

	public function exams_alter(){
    	if(empty($_POST)){
    		$kid = I("get.id"); /*考试人id*/
			$model = M('score');
			$where =[];
			$wheres =[];
			$where['lamp_score.scoreid']=['eq',$kid];
			$where['lamp_question_bank.qbtype']=['in','4'];
			$tk = $model ->join('LEFT JOIN lamp_question_bank on lamp_score.qbid= lamp_question_bank.qbid')
			->where($where)
			->select();
			$wheres['lamp_score.scoreid']=['eq',$kid];
			$wheres['lamp_question_bank.qbtype']=['in','3'];
			$wd = $model ->join('LEFT JOIN lamp_question_bank on lamp_score.qbid= lamp_question_bank.qbid')
			->where($wheres)
			->select();
			$this -> assign('first');
			$this -> assign('kid',$kid);
			$this -> assign('tks',$tk);
			$this -> assign('wds',$wd);
			$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		echo '获取到值吗？';
    	}
    }
    public function exams_del(){
    	$id = I('post.id');
    	$model = M('reportcard');
    	$del = $model
    		-> where("reportid = $id")
			-> delete();
		if($del == true){
			echo 1;
		}else{
			echo 2;
		}
			
    }

}