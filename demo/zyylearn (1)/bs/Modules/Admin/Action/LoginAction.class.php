<?php
class LoginAction extends Action{
		//显示登录页面
		Public function login(){
			$this->display('Index:login');
		}

		//调用公共函数auth_login验证登录信息
		Public function auth(){
				if(!IS_AJAX) halt("页面不存在");
				
				$statu=auth_login($_POST[type],$_POST[username],$_POST[passwd]);
				$this->ajaxReturn(array('status'=>$statu),'json');	
			//	$this->ajaxReturn(array('status'=>0),'json');	
		}

		//退出登录，销毁session	
		Public function logout(){
			//	if(!IS_AJAX) halt("页面不存在");
				session(null);
				$this->redirect("Index/Index/index"); 
		}
}
