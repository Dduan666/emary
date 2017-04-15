<?php
namespace Home\Controller;
use Think\Controller;
class SimulateController extends Controller {
	public function simulate_index(){
        $model = M('class');
        $list = $model -> where('classnumber = 1') -> select();
        $this -> assign('list',$list);
        $list1 = $model -> where('classnumber = 2') -> select();
        $this -> assign('list1', $list1);
        $list2 = $model -> where('classnumber = 3') -> select();
	    $this -> assign('list2', $list2);
	    $this -> id = session('id');
	    $this -> name = session('name');
		$this -> display();
    }
	public function simulate_paper(){
		if(empty($_POST)){
			$classid = I('get.id');
			$model = M('question_bank');
			/*单选题*/
			$id0 = $model -> where(array('classid'=>$classid,'qbtype'=>0)) -> field('qbid') -> select();
			$rand0 = array_rand($id0,2);
			foreach($rand0 as $val){
				foreach($id0[$val] as $v){
					$dx[] = $model
						  -> where(array('qbid'=>$v))
						  -> field('qbid,qbname,qbbeixuan')
						  -> select();
				}
			}
			$this -> assign('dx',$dx);
			/*判断题*/
			$id2 = $model -> where(array('classid'=>$classid,'qbtype'=>2)) -> field('qbid') -> select();
			$rand2 = array_rand($id2,2);
			foreach($rand2 as $val){
				foreach($id2[$val] as $v){
					$pd[] = $model
						  -> where(array('qbid'=>$v))
						  -> field('qbid,qbname,qbbeixuan')
						  -> select();
				}
			}
			$this -> assign('pd',$pd);
			$this -> display();
		}else{
			if(empty($_POST)){
				echo "<script>alert('请填写答案');</script>";
			}else{
				$data = I('post.');
				$userid = session('id');
				$model = M('score');
				$scoreid = $model -> max('scoreid');
				$date = date('Y-m-d H:i:s');
				$grade = 2;
				$datalist = array();
				foreach($data as $key => $val){
					$list['scoreid'] = $scoreid+1;
					$list['qbid'] = $key;
					$list['scoreanswer'] = $val;
					$list['scoredate'] = $date;
					$list['scoregrade'] = $grade;
					$datalist[] = $list;
				}
				$add = $model -> addAll($datalist);
				if($add){
					foreach($data as $key => $val){
						$where = array('lamp_score.qbid' => $key,'lamp_score.scoreid' => $scoreid);
						$judge = $model
						   	   -> where($where)
						   	   -> join('LEFT JOIN lamp_question_bank on lamp_score.qbid = lamp_question_bank.qbid')
						   	   -> field('lamp_score.id,lamp_score.qbid,lamp_score.scoreid,lamp_score.scoreanswer,lamp_question_bank.qbid,lamp_question_bank.qbdaan')
						   	   -> select();
						foreach($judge as $vals){
						   	if($vals['qbdaan'] == $vals['scoreanswer']){
						   		$sum += 5; 
						   	}
						}
					}
					$models = M('reportcard');
					$score = $models
						   -> add(array(
						   		'userid' => $userid,
						   		'scoreid' => $scoreid,
						   		'totalscore' => $sum,
						   		'date' => $date,
						   		'grade' => $grade));
					if($score){
						echo "<script>window.location.href='".U('Simulate/simulate_right')."';</script>";
					}else{
						echo 'error';
					}	   			
				}else{
					echo 'error';
				}
			}
		}
	}
	public function simulate_right(){
		if(empty($_POST)){
			$id = session('id');
			$model = M('reportcard');
			$con = $model -> count();
			$Page = new\ Think\Page($con,20);
			$show = $Page -> show();
			$list = $model
				  -> join('LEFT JOIN lamp_user_business on lamp_reportcard.userid = lamp_user_business.id')
				  -> field('lamp_reportcard.*,lamp_user_business.name')
				  -> where(array('lamp_reportcard.userid' => $id,'lamp_reportcard.grade' => 2))
				  -> limit($Page -> firstRow.','.$Page -> listRows)
				  -> order('reportid desc')
				  -> select();
			$this -> assign('first');
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			$this -> display();
		}else{
			
		}
		
	}
}