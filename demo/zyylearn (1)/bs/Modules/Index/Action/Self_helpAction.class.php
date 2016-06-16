<?php
class Self_helpAction extends Action{
		public function index(){
				$question=M('question')->where('Qstatus=1')->field('Qid,Qtitle')->select();
				$this->assign('alist',$question);
				$this->display("Index:self_help");
		}
		//返回搜寻结果
	public function search(){
			$query="select Qid,Qtitle from question where (Qstatus=1) and (Qtitle like '%".$_POST['keyword']."%' or Qcontent like '%".$_POST['keyword']."%')";
			$question=M('question');
			$result=$question->query($query);
			if(!$result){
				$this->ajaxReturn(array('status'=>0),'json');
			}else{
				$result['status']=1;
				$this->ajaxReturn($result,'json');
			}
	}

		//进入答案详情
		public function detail(){
				$q_list=M('question')->where('Qid='.$_GET['Qid'])->field('Qtitle,Qcontent,Qid')->select();
				$result=QA($q_list);
				$this->assign('list',$result);
			//	p($result);
			//	exit;
				$this->display("Index:self_detail");
		}
}
