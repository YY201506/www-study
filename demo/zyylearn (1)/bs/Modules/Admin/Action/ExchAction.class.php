<?php
class ExchAction extends Action{
		public function index(){
				if(!$_SESSION['login']) halt("页面不存在");
				$list=read_talk('','');
				$this->assign("list",$list);
		$this->display('Index:help_ans');
		}

		public function del(){
				$result1=M('interaction')->where('NumId='.$_POST['d_id'])->delete();
				$result2=M('interaction')->where('First='.$_POST['d_id'])->delete();
				if($result1 && $result2){
					$result=1;
				}else{
					$result=0;
				}
				$this->ajaxReturn(array('status'=>$result),'json');
				//注意要删除楼主的话和回复的话，才算是把一个话题彻底删除
		}
}
