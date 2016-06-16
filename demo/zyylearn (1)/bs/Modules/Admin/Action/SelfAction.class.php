<?php
class SelfAction extends Action{
		public function index(){
				if(!$_SESSION['login']) halt("页面不存在");
				$result=M('question')->where('Qstatus=1')->field('Qid,Qtitle,Qcontent')->select();
				$this->assign('Qlist',$result);
		$this->display('Index:self_ans');
		}
//问题详情
		public function answer_detai(){
				if(!$_SESSION['login']) halt("页面不存在");

				$a_list=M('answer')->where("Qid=".$_GET['id']." and Acontent !=''")->field('Acontent,Ateacher,Qid')->select();
				$result=QA($a_list);
			//	p($result);
			//	exit;
				$this->assign('result',$result);
				$this->assign('question',$result[0]['question']);
				$this->display('Index:self_ansdetail');
		}

		public function del(){
				//		p($_POST);
				$question=M('question')->where('Qid='.$_POST['Qid'])->delete();
				$answer=M('answer')->where('Qid='.$_POST['Qid'])->delete();
				if($question && $answer){
				$this->ajaxReturn(array('status'=>1),'json');
				}else{
				$this->ajaxReturn(array('status'=>0),'json');
				}
		}
}
