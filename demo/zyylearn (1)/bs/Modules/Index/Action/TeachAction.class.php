<?php
class TeachAction extends Action{
		public function index(){
				$teacherlist=M('teacher')->select();
				$this->assign('teacherlist',$teacherlist);
		$this->display("Index:teacher_teach");
		}
		//接收提问的信息，并写入数据库
		public function submit(){
				if(!IS_AJAX) halt("页面不存在");
				
				$data_q['Qtitle']=$_POST['title'];
				$data_q['Qcontent']=$_POST['content'];
				$data_q['Quser']=$_POST['quser'];
				$result_q=M('question')->add($data_q);
				$i=0;
				if($result_q){
					foreach($_POST['teacher'] as $value){
							$data_a[$i]['Ateacher']=$value;
							$data_a[$i]['Qid']=$result_q;
							$i=$i+1;
					}
//					print_r($data_a);
					$result_a=M('answer')->addAll($data_a);
				}
				$this->ajaxReturn(array('status'=>$result_a),'json');
		}

		//待解决问题的方法
		public function nosolve(){
				if(!$_SESSION['login']){
						$this->error("你需要登录才能看到你自己喔!");
				}
				$question=M('question')->where("Quser='".$_SESSION['login']."' and Qstatus=0")->select();
				$this->assign('qlist',$question);
				$this->display('Index:daijiejue');

		}
		//已经解决的问题
		public function solve(){
				if(!$_SESSION['login']){
						$this->error("你需要登录才能看你自己喔!");
				}
				$q_list=M('question')->where("Quser='".$_SESSION['login']."' and Qstatus=1")->field('Qid,Qcontent,Qtitle')->select();
				//p($q_list);
				//echo "<hr>";
/*				$i=0;
				foreach($q_list as $question){
						//p($question);
						$result[$i]['answer']=M('answer')->where("Qid=".$question['Qid']." and Acontent != ''")->field('Acontent,Ateacher')->select();
						$result[$i]['question']=$question['Qcontent'];
						$result[$i]['title']=$question['Qtitle'];
						$i=$i+1;
				}*/
				$result=QA($q_list);
				//p($result);
				//exit;
				$this->assign('result',$result);//注意模版中遍历多为数组的方法
				$this->display('Index:already_ans');
		}
}
