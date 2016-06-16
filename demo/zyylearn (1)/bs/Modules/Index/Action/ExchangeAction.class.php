<?php
class ExchangeAction extends Action{
	//显示话题列表的方法
	public function index(){
		$data=read_talk($_SESSION['login'],$_GET['list']);
		$this->assign('interaction',$data);
		$this->display("Index:exchange");
	}

	//显示我要发起话题模板的方法
	public function to_talk(){
		$this->display("Index:to_talk");
	}

	//提交话题内容，写入数据库
	public function write_t(){
		if(!IS_AJAX) halt('页面不存在');
		//print_r($_POST);
		$arr['NumId']='';
		$arr['Content']=$_POST['Content'];
		$arr['UserName']=$_POST['UserName'];
		$arr['First']=0;

		$interaction=M('interaction');
		$result=$interaction->add($arr);
		$this->ajaxReturn(array('status'=>$result),'json');

		//var_dump($result);
		//$query="nsert into interaction values('','".$UserName."',NOW(),'".$Content."',1)";
		//$result=$interaction->query($query);
	}

	//显示话题详情页面的方法
	public function t_detail(){
		$interaction=M('interaction');
		$query="select * from interaction where NumId=".$_GET['id'];
		//$left=$interaction->query($query);
		$main=$interaction->where("NumId=".$_GET['id'])->select();//楼主的话
		$replay=$interaction->where("First=".$_GET['id'])->order('Time')->select();
		//回复的话显示在右边，（包括楼主的回复，如果取出的名字和楼主名字同就显示在左边）

		$this->assign('main',$main);//此时传递一个二维数组过去，在模板要{$main[0]['xxx']}才能输出变量值
		$this->assign('replay',$replay);
		//$this->assign('')
		$this->display("Index:exchange_detail");
	}

	//回复话题的方法
	public function say(){
		if(!IS_AJAX) halt('页面不存在');
		print_r($_POST);
		$arr['NumId']='';
		$arr['Content']=$_POST['Content'];
		$arr['UserName']=$_POST['UserName'];
		$arr['First']=$_POST['First'];
		$interaction=M('interaction');
		$result=$interaction->add($arr);
		$this->ajaxReturn(array('status'=>$result),'json');
	}
}
