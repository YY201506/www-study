<?php
class Online_textAction extends Action{
	public function index(){
				$list=M('t_list')->select();
				$this->assign('list',$list);
				$this->display("Index:online_text");
	}

	public function text_ans(){
				$result=M('text')->where('TextId='.$_GET['num'])->select();//读取测试题内容
				$title=M('t_list')->where('TextId='.$_GET['num'])->getField('T_title');//读取测试题标题
				$StudentId=M('student')->where("UserName='".$_SESSION['login']."'")->getField("UserId");//读取答题者的用户ID号

				$queryErr="select Tid,errAns from texterr where TextId=".$_GET['num']." and StudentId=".$StudentId;
				$error=M('texterr')->query($queryErr);
				$i=0;
				foreach($result as $data){
						foreach($error as $err){
								if($data['Id'] == $err['Tid']){
									$content[$i]['err']=$err['errAns'];
									break;
								}else{
									$content[$i]['err']=0;
									break;
	/*								$content[$i]['answer']=$data['answer'];
									$content[$i]['answerA']=$data['answerA'];
									$content[$i]['answerB']=$data['answerB'];
									$content[$i]['answerC']=$data['answerC'];
									$content[$i]['answerD']=$data['answerD'];
									$content[$i]['Title']=$data['Title'];*/
								}
						}
									
									$content[$i]['answer']=$data['answer'];
									$content[$i]['answerA']=$data['answerA'];
									$content[$i]['answerB']=$data['answerB'];
									$content[$i]['answerC']=$data['answerC'];
									$content[$i]['answerD']=$data['answerD'];
									$content[$i]['Title']=$data['Title'];
						$i=$i+1;
				}
				$this->assign('title',$title);
				$this->assign('list',$content);
				$this->display("Index:online_text_ans");
	}
	public function text_do(){
			$result=M('text')->where('TextId='.$_GET['num'])->select();
			$title=M('t_list')->where('TextId='.$_GET['num'])->getField('T_title');
			$this->assign('title',$title);
			$this->assign('list',$result);
			$this->display("Index:online_text_do");
	}

	//返回已做的习题的标题
	public function Y_title(){
			if(!IS_AJAX) halt('页面不存在');
			$UserId=M('student')->where("UserName='".$_POST['UserName']."'")->getField('UserId');
			$t_list=M('t_list');
			$query="select TextId from textsta where StudentId=".$UserId;
			$textsta=M('textsta');
			$result=$textsta->query($query);
			$i=0;
			foreach($result as $data){
					$title[$i]['T_title']=$t_list->where('TextId='.$data['TextId'])->getField('T_title');
					$title[$i]['TextId']=$data['TextId'];
					$i=$i+1;
			}
			if(!count($title)){
				$this->ajaxReturn(array('status'=>0),'json');
			}else{
				$this->ajaxReturn(array('status'=>1,'title'=>$title));
			}
	}
	//返回未做的习题标题
	public function N_title(){
			if(!IS_AJAX) halt('页面不存在');
			$UserId=M('student')->where("UserName='".$_POST['UserName']."'")->getField('UserId');
			$t_list=M('t_list');
			$query1="select TextId from textsta where StudentId=".$UserId;
			$textsta=M('textsta');
			$result=$textsta->query($query1);
			if(!count($result)){
				$query2="select T_title,TextId from t_list";
			}else{
			$i=0;
			foreach($result as $data){
					$tmp[$i]=$data['TextId'];
					$i=$i+1;
			}
			$str=implode(",",$tmp);
			$query2="select T_title,TextId from t_list where TextId not in (".$str.")";
			}
			$title=$t_list->query($query2);
			if(!count($title)){
				$this->ajaxReturn(array('status'=>0),'json');
			}else{
				$this->ajaxReturn(array('status'=>1,'title'=>$title));
			}
	}

	//提交答题
	public function write(){
			if(!IS_AJAX)halt('页面不存在');
			$data1['StudentId']=M('student')->where("UserName='".$_POST['user']."'")->getField('UserId');
			$data1['TextId']=$_POST['textId'];
			$result1=M('textsta')->add($data1);
			$answer=$_POST['answer'];
			$query="select Id,answer from text where textId=".$_POST['textId'];
			$Yans=M('text')->query($query);
			$tmp=0;
			foreach($answer as $arr){
					foreach($Yans as $Yarr){
							if($arr[1] == $Yarr['Id']){
								if($arr[0] == $Yarr['answer']){
									continue;
								}else{
									$data[$tmp]['Tid']=$arr[1];
									$data[$tmp]['errAns']=$arr[0];
									$data[$tmp]['TextId']=$_POST['textId'];
									$data[$tmp]['StudentId']=$data1['StudentId'];
									$tmp=$tmp+1;
								}
							continue;
							}
					}
			}
			if(!count($data)){
				$this->ajaxReturn(array('status'=>1),'json');
			}else{
			for($i=0;$i<$tmp;$i++){
					$result[$i]=M('texterr')->add($data[$i]);
					if(!$result[$i]){
						$str=0;
					}else{
						$str=1;
					}
			}
			$this->ajaxReturn(array('status'=>$str),'json');
		}
	}
}
