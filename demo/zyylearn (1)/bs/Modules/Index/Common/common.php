<?php
/*
	function read_talk($name){
		if($name ==''){  //获取全部话题
//		$interaction=M('interaction')->getField('NumId,UserName,Time,Content');
			$interaction=M('interaction')->select();
//			p($interaction);
		}else{
//			$query="select * from interaction where UserName='".$name."'";
		//	$result=$interaction->query($query);
			$interaction=M('interaction')->where("UserName='".$name."'")->select();
			//			p($interaction);
			return $interaction;
		}
	}
 */
?>
