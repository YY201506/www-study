<?php
class OnleAction extends Action{
		public function index(){
				if(!$_SESSION['login']) halt("页面不存在");
				$text=M('t_list')->order('TextId')->select();
			//	p($text);
			//	die;
				$this->assign('list',$text);
					$this->display('Index:online');
		}
//显示试题详情
		public function detail(){
				if(!$_SESSION['login']) halt("页面不存在");
				$text=M('text')->where('TextId='.$_GET['id'])->select();
				$this->assign('title',$_GET['title']);
				$this->assign('content',$text);
				//p($text);
				//die;
					$this->display('Index:online_detail');
			
		}
//显示新增试题表单
		public function newbuild(){
					if(!$_SESSION['login']) halt("页面不存在");
					$this->display('Index:online_newbuild');
		
		}

		//接收新增试题数据，写入数据库
		public function writeText(){
				if(!$_SESSION['login']) halt("页面不存在");
				$data_t['T_title']=$_POST['T_title'];
				$TextId=M('t_list')->add($data_t);
				if(!$TextId){
					$this->ajaxReturn(array('status'=>0,'json'));
				}else{
					$num=count($_POST[data]);
					for($i=0;$i<$num;$i++){
							$data[$i]['TextId']=$TextId;
							$data[$i]['Title']=$_POST[data][$i][0];
							$data[$i]['answer']=$_POST[data][$i][1];
							$data[$i]['answerA']=$_POST[data][$i][2];
							$data[$i]['answerB']=$_POST[data][$i][3];
							$data[$i]['answerC']=$_POST[data][$i][4];
							$data[$i]['answerD']=$_POST[data][$i][5];
							$result[$i]=M('text')->add($data[$i]);
					}
					if(!$result[$num-1]){
						$this->ajaxReturn(array('status'=>0,'json'));
					}else{
						$this->ajaxReturn(array('status'=>1,'json'));
					}
				}
		}
		//更新修改测试题内容
		public function updateText(){
				if(!$_SESSION['login']) halt('页面不存在');
				$num=count($_POST[data]);
				$tmp=0;
				for($i=0;$i<$num;$i++){
					$data[$i]['Title']=$_POST[data][$i][0];
					$data[$i]['answer']=$_POST[data][$i][1];
					$data[$i]['answerA']=$_POST[data][$i][2];
					$data[$i]['answerB']=$_POST[data][$i][3];
					$data[$i]['answerC']=$_POST[data][$i][4];
					$data[$i]['answerD']=$_POST[data][$i][5];
					$result[$i]=M('text')->where('Id='.$_POST[data][$i][6])->save($data[$i]);
					$tmp=$tmp+$result[$i];
				}
				
					if(!$tmp){
						$this->ajaxReturn(array('status'=>0,'json'));
					}else{
						$this->ajaxReturn(array('status'=>1,'json'));
					}
		}

		//删除测试题
		public function del(){
				$result1=M('t_list')->where('TextId='.$_POST['TextId'])->delete();
				$result2=M('text')->where('TextId='.$_POST['TextId'])->delete();
				$result3=M('textsta')->where('TextId='.$_POST['TextId'])->delete();
				$result3=M('texterr')->where('TextId='.$_POST['TextId'])->delete();
				if($result1 && $result2){
					$this->ajaxReturn(array('status'=>1),'json');
				}else{
					$this->ajaxReturn(array('status'=>0),'json');
				}
		}
}
