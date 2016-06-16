<?php
//这里是后台的首页模版控制器 
class UserAction extends Action {
		public function index(){
				if(!$_SESSION['login']) halt("页面不存在");

				$student=M('student')->select();
				$admin=M('admin')->select();
				$teacher=M('teacher')->select();
				
				$this->assign('studentlist',$student);
				$this->assign('adminlist',$admin);
				$this->assign('teacherlist',$teacher);
				$this->display("Index:user_manage");
		}

		public function alter(){
			//	print_r($_POST);谨记在json返回值之前不恩能够有信息输出，否则，传递过去的json值会出错
				$newdata['UserName']=$_POST['new_username'];
				$newdata['UserPasswd']=$_POST['new_passwd'];
				$result=M($_POST['type'])->where('UserId='.$_POST['d_id'])->save($newdata);
			//	var_dump($user);
				$this->ajaxReturn(array('status'=>$result),'json');
			//	$this->ajaxReturn(array('status'=>$statu),'json');
		}

		public function del(){
				$result=M($_POST['type'])->where('UserId='.$_POST['d_id'])->delete();
				$this->ajaxReturn(array('status'=>$result),'json');
		}

		public function add(){
				$result=M('teacher')->add($_POST);
				$this->ajaxReturn(array('status'=>$result));
		}
}
