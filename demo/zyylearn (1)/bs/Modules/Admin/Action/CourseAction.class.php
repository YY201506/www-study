<?php
class CourseAction extends Action{
		public function index($type=''){
					if(!$_SESSION['login']) halt("页面不存在");
		$result=read_sourse($type);
		$this->assign('list',$result);
		$this->display('Index:resource');

		}	
		public function upload() {
					if(!$_SESSION['login']) halt("页面不存在");
//			print_r($_POST);
//			die;
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->saveRule = time;  //此参数为空，则上传文件保存名字不变，详见文档说明
	    $upload->maxSize  = 314572800000 ;// 设置附件上传大小
//		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath ="./bs/course_upload/".$_POST['type']."/";// 设置附件上传目录
		//注意：  ./  表示目录/BS/,要区别与一般的路径表示法
		//
		//p($_POST);   测试得知file类型的内容不会通过post提交
		if(!$upload->upload()) {// 上传错误提示错误信息   ,upload函数会读取表单中类型为file的文件进行上传
			//$this->error($upload->getErrorMsg());
			echo $upload->getErrorMsg();
		}else{// 上传成功
			$arr=$upload->getUploadFileInfo();
			$arr=$arr[0];
//			p($arr);
//			die;
			$data['saveName']=$arr['savename'];
			if(!$_POST['title'] == ''){
				$data['courseTitle']=$_POST['title'];
			}else{
				$data['courseTitle']=$arr['name'];
			}
			$data['loadUrl']='/bs/course_upload/'.$_POST['type']."/";
			$data['class']=$_POST['type'];
			/*
			switch($_POST['type']){
				case 'book';
					$data['loadUrl']=$data['loadUrl']."book";
					break;
				case 'vedio';
					$data['loadUrl']=$data['loadUrl']."video";
					break;
				case 'literature':
					$data['loadUrl']=$data['loadUrl']."literature";
				break;
				default:
					break;
			}*/
			$course=M('course');
			$result=$course->add($data);
//			$this->ajaxReturn(array('data=>'.$result),'json');
//			var_dump($result);
			$this->success('上传成功！','Index/Cource/index');

			//p($arr);
		    }
		}	

		public function delete(){
				//	if(!$IS_AJAX) halt("页面不存在");
				$resource=M('course');	
				$result=$resource->where('NumId='.$_POST['d_id'])->delete();
						$this->ajaxReturn(array('status'=>$result),'json');
		}

}
