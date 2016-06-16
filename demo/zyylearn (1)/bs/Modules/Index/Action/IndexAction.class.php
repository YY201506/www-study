<?php
//这文档是前端的控制器集合
class IndexAction extends Action {
	//首页的控制器
	public function index(){
			$this->display("index");
	}

	//注册页面的控制器
	public function  submit(){
		if(!IS_AJAX) halt("页面不存在！");
		$result=regist($_POST['username'],$_POST['passwd']);
		$this->ajaxReturn(array('status'=>$result),'json');
	}
	//注意：登录和退出放在后台Login控制器了
	//
	public function register(){
		$this->display("Index:zhuce");
	}
}
