<?php
function test(){
echo "这是后台独立函数库的文件<br>独立分组的函数库要命名成function.php,否则不加载";
}
//返回导航的动态
function A_sub(){
	$userUrl=U('Admin/User/index','','');
	$exchUrl=U('Admin/Exch/index','','');
	$ResoUrl=U('Admin/Course/index','','');
	$OnleUrl=U('Admin/Onle/index','','');
	$SelfUrl=U('Admin/Self/index','','');
	 $string="<li><a href='".$userUrl."'"; if(MODULE_NAME =="User"){$string=$string." class='current'";}
		 $string=$string.">用户管理</a></li><li><a href='".$exchUrl."'";if(MODULE_NAME == "Exch"){$string=$string." class='current'";}
		 $string=$string.">交流互动管理</a></li><li><a href='".$ResoUrl."'";if(MODULE_NAME == "Course"){$string=$string." class='current'";}
		 $string=$string.">课程资源管理</a></li><li><a href='".$OnleUrl."'";if(MODULE_NAME == "Onle"){$string=$string." class='current'";}
		 $string=$string.">在线学习管理</a></li><li><a href='".$SelfUrl."'";if(MODULE_NAME == "Self"){$string=$string." class='current'";}
		 $string=$string.">自助答疑管理</a></li>";
	 return $string;
}

//返回问题答案的重组数组,知道答
function QA($a_list){
				$i=0;
				foreach($a_list as $answer){
						//p($question);
						$result[$i]['question']=M('question')->where("Qid=".$answer['Qid'])->field('Qcontent,Qtitle')->select();
						$result[$i]['answer']=$answer['Acontent'];
						$result[$i]['Qid']=$answer['Qid'];
						$result[$i]['Ateacher']=$answer['Ateacher'];
						$i=$i+1;
				}
				return $result;
}

//动态返回回答或未回答的样式
function QA_Y(){
	if(ACTION_NAME =='index'){echo "class='active'";}
}
function QA_N(){
	if(ACTION_NAME =='wait'){echo "class='active'";}
}

//判断哪个是正确答案且返回
function answer($sub){
	switch($sub){
	case 'A':
			return "A";
	case 'B':
			return "B";
	case 'C':
			return "C";
	case 'D':
			return "D";
	default:
			break;
	}
}

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
