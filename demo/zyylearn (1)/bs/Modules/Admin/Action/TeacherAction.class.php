<?php
class TeacherAction extends Action{
		public function index(){
				if(!$_SESSION['login']) halt("页面不存在.");
				$a_list=M('answer')->where("Ateacher='".$_SESSION['login']."' and Acontent !=''")->field('Qid,Acontent')->select();
			//	p($a_list);
			//	echo "<hr>";
				//	p($result);
				$result=QA($a_list);

			//	exit;
				$this->assign('result',$result);//注意模版中遍历多为数组的方法
			$this->display("Index:miss_personal");
		}
		//待回答的控制方法
		public function wait(){
				if(!$_SESSION['login']) halt("页面不存在");
				$a_list=M('answer')->where("Ateacher='".$_SESSION['login']."' and Acontent is null")->field('Qid')->select();//注意为空的判定写法，区别于不为空
				$result=QA($a_list);
			//	p($result);
		//		exit;
				$this->assign('result',$result);//注意模版中遍历多为数组的方法
				$this->display('Index:miss_personal');
		}
		//老师回答的控制方法
		public function answer(){
				$data_q['Qstatus']=1;
				$data_a['Acontent']=$_POST['Acontent'];
			//	p($_POST);
			//	exit;
				$statu_q=M('question')->where("Qid=".$_POST['Qid'])->save($data_q);
				$statu_a=M('answer')->where("Ateacher='".$_SESSION['login']."' and Qid=".$_POST['Qid'])->save($data_a);
				if($statu_q && $statu_a){
				$this->ajaxReturn(array("status"=>1),'json');
				}else{
				$this->ajaxReturn(array("status"=>0),'json');
				}
		}
		
}
