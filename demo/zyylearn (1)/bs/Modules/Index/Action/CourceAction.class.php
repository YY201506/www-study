<?php
class CourceAction extends Action{
	public function index($type=''){
		/*
		$course=M('course');
		switch($type){
		case '':
			$result=$course->select();
			break;
		default:
			$result=$course->where("class='".$type."'")->select();
			break;
		}*/
		$result=read_sourse($type);
		$this->assign('list',$result);
		$this->display("Index:class_cource");
	}



	
	public function download($id){
		$course_d=M('course');
		$result_d=$course_d->where('NumId='.$id)->select();
		$result_d=$result_d[0];
	//	echo	$_SERVER[DOCUMENT_ROOT];
	//	die;
				download($result_d['loadUrl'],$result_d['saveName']);
			//	download("C(__APP__)/bs/course_upload/book/",'52df7c5d701ba.txt');
	}

}
