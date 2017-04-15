<?php
namespace Exam\Controller;
use Think\Controller;
class FileController extends Controller {
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
	public function attachs(){
		$model = M('files');
    	if(empty($_POST)){
			$count  = $model -> count();
			$Page = new \Think\Page($count,10);
			$show = $Page -> show();
			$list = $model
				  -> alias('a')
				  -> join('LEFT JOIN lamp_user_business b on a.userid = b.id')
                  -> field('a.*,b.rank,b.name')
				  -> order('a.id desc')
				  -> limit($Page -> firstRow.','.$Page -> listRows)
				  -> select();
			$this -> assign('list',$list);
			$this -> assign('page',$show);
			$this -> id = session('id');
			$this -> name = session('name');
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
	public function attachs_add(){
    	if(empty($_POST)){
    		$model = M('class');
			$list = $model -> where('pid = 1') -> select();
			$this -> assign('list',$list);
    		$this -> id = session('id');
			$this -> name = session('name');
			$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		echo '获取到值';		
		}
	}
	public function attachs_alter(){
		$model = M('files');
    	if(empty($_POST)){
    		$id = I('get.id');
			$sel = $model
				 -> field('id,fname')
				 -> where("id = $id")
				 -> find();
			$this -> assign('sel',$sel);
			$this -> rank = session('rank');
    		$this -> display();
    	}else{
    		$data = I('post.');
			foreach($data as $key => $val){
				$data = array('id'=>$key,'fname'=>$val);
				$sa = $model -> save($data);
			}
			if($sa !== false){
				echo "<script>alert('成功');
					window.location.href='".U('File/attachs')."';
					</script>";
			}else{
				echo 'error';
			}
		}
	}
	public function attachs_dels(){
		$data = I('post.ids');
		$model = M('question_bank');
		$dels = $model->delete($data);
		if($dels){
			echo 0;
		}else{
			echo 1;
		}
	}
	public function fileupload(){
		$id = session('id');
		if(!empty($id)){
			$upload = new \Think\Upload();
			$upload -> maxSize = 10000000000;
			$upload -> exts = array('jpg','gif','png','jpeg','html','doc','docx','pdf','mp4','mp3','wmv','pptx','ppt');
			$upload -> savePath = 'Uploads/files/';
			$info = $upload -> upload();
			// dump($upload);
			// dump($info);die();
			if(!$info) {
				echo 'error';
			}else{
				$model = M('files');
				foreach($info as $val){
					$pid = I('post.classid');
					$ftype = I('post.ftype');
					$date = date('Y-m-d');
					$url = $val['savepath'].$val['savename'];
					$add = $model
						 -> add(array(
						 'fname' 	=> $val['name'],
						 'filename' => $val['savename'],
						 'filetype' => $val['ext'],
						 'fileurl'  => $url,
						 'filetime' => $date,
						 'userid'   => $id,
						 'pid'      => $pid,
						 'ftype'    => $ftype
						 ));
				}
				if($add){
						echo "<script>alert('成功');
						window.location.href='".U('File/attachs_add')."';
						</script>";
					}else{
						echo "<script>alert('失败');
						window.history.back(-1);
						</script>";
					}
			}
		}else{
			echo "<script>alert('请重试！');
			window.location.href='".U('File/attachs_add')."';
			</script>";
		}
		
		
	}
    public function ajaxFileUpload(){
        $file = $_FILES;
		$path = './Public/Uploads/files';
		$info = $this->uploadFile($path);//可以在后面定义参数
		if(!$info) {
		  	$this->ajaxReturn(
                [
                    'success' => false,
                    'msg' => $upload,
                ]
            );
		  	// 上传错误提示错误信息       
		}else{
            $this->ajaxReturn(
                [
                    'success' => true,
                    'msg' => 'ok',
                    'urlPath' => $info,
                ]
            );
        }  
        
    }
public function buildInfo(){
	if(!$_FILES){
		return ;
	}
	$i=0;
	foreach($_FILES as $v){
		//单文件
		if(is_string($v['name'])){
			$files[$i]=$v;
			$i++;
		}else{
			//多文件
			foreach($v['name'] as $key=>$val){
				$files[$i]['name']=$val;
				$files[$i]['size']=$v['size'][$key];
				$files[$i]['tmp_name']=$v['tmp_name'][$key];
				$files[$i]['error']=$v['error'][$key];
				$files[$i]['type']=$v['type'][$key];
				$i++;
			}
		}
	}
	return $files;
}
public function uploadFile($path="uploads",$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=false){
	if(!file_exists($path)){
		mkdir($path,0777,true);
	}
	$i=0;
	$files=$this->buildInfo();
	if(!($files&&is_array($files))){
		return ;
	}
	foreach($files as $file){
		if($file['error']===UPLOAD_ERR_OK){
			$ext=$this->getExt($file['name']);
			//检测文件的扩展名
			if(!in_array($ext,$allowExt)){
				exit("非法文件类型");
			}
			//校验是否是一个真正的图片类型
			if($imgFlag){
				if(!getimagesize($file['tmp_name'])){
					exit("不是真正的图片类型");
				}
			}
			//上传文件的大小
			if($file['size']>$maxSize){
				exit("上传文件过大");
			}
			if(!is_uploaded_file($file['tmp_name'])){
				exit("不是通过HTTP POST方式上传上来的");
			}
			$filename=$this->getUniName().".".$ext;
			$destination=$path."/".$filename;
			if(move_uploaded_file($file['tmp_name'], $destination)){
				$file['name']=$filename;
				unset($file['tmp_name'],$file['size'],$file['type']);
				$uploadedFiles[$i]=$file;
				$i++;
			}
		}else{
			switch($file['error']){
					case 1:
						$mes="超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
						break;
					case 2:
						$mes="超过了表单设置上传文件的大小";			//UPLOAD_ERR_FORM_SIZE
						break;
					case 3:
						$mes="文件部分被上传";//UPLOAD_ERR_PARTIAL
						break;
					case 4:
						$mes="没有文件被上传1111";//UPLOAD_ERR_NO_FILE
						break;
					case 6:
						$mes="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
						break;
					case 7:
						$mes="文件不可写";//UPLOAD_ERR_CANT_WRITE;
						break;
					case 8:
						$mes="由于PHP的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
						break;
				}
				echo $mes;
			}
	}
	return $uploadedFiles;
}
/**
 * 生成唯一字符串
 * @return string
 */
public function getUniName(){
	return md5(uniqid(microtime(true),true));
}

/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
public function getExt($filename){
	return strtolower(end(explode(".",$filename)));
}
	
}
