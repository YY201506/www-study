<?php
/**这个是项目的公共文件，任何地方都会默认引入次文件**/

//以下是公共处理，防止出现对双引号等出现二次转义
if (get_magic_quotes_gpc()) {
     function stripslashes_deep($value)
     {
         $value = is_array($value) ?
                     array_map('stripslashes_deep', $value) :
                     stripslashes($value);
         return $value;
     }
     $_POST = array_map('stripslashes_deep', $_POST);
     $_GET = array_map('stripslashes_deep', $_GET);
     $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
 }


//function test(){echo "公共函数库";}
//打印数组的函数
function p($array){
	dump($array,1,'<pre>',0);
}

//检查登录session值，检查是否登录
function check_session(){
			if(GROUP_NAME =='Index'){
				if(session('?login')){
				//if(isset($_SESSION['login'])){
					$string="<span>".$_SESSION['login']."，欢迎您!</span>&nbsp&nbsp<a href=".U('Admin/Login/logout','','').">[退出登录]</a>";
				 	return $string;
				}else{
					$string="<a href=".U('Index/Index/register','','').">注册</a>&nbsp&nbsp&nbsp&nbsp<a href=".U('Admin/Login/login','','').">登录</a>";
					return $string;
				}
			}elseif(GROUP_NAME =='Admin'){
				if(session('?login')){
					$string="<span>".$_SESSION['login']."，欢迎您!</span>&nbsp&nbsp<a href=".U('Admin/Login/logout','','').">[退出登录]</a>";
				 	return $string;
				}
			}
}

//登录验证操作
function auth_login($type,$name,$passwd){//注意操作mysql数据库不区分大小写的
	$data=M($type)->where("username='".$name."' and userpasswd='".$passwd."'")->select();
//	$arr['type']
	//print_r($data);
	//die;
		if($data){
				session('login',$name);	
				return 1;
		}else{
				//echo "NoNO";
				return 0;
		}
}




//交流互助读取话题
function read_talk($name,$list){
		if($list !='' || $name ==''){  //获取全部话题
//		$interaction=M('interaction')->getField('NumId,UserName,Time,Content');
			$interaction=M('interaction')->where("first=0")->order('Time')->select();   //first=1表示发起的话题，为0表示一般性的回复
//			p($interaction);
		}elseif($list =='' && $name !=''){			
//			$query="select * from interaction where UserName='".$name."'";
		//	$result=$interaction->query($query);
			$interaction=M('interaction')->where("UserName='".$name."' AND first=0")->order('Time')->select();
			//			p($interaction);
		}
			return $interaction;
	}



//读取资源数据库列表方法

function read_sourse($type=''){
		$course=M('course');
		switch($type){
		case '':
			$result=$course->select();
			break;
		default:
			$result=$course->where("class='".$type."'")->select();
			break;
		}
		return $result;
}
//动态返回资源分类的按钮颜色
function book_sub(){
	if($_GET['type']=='book')
		echo "class='active'";
}
function video_sub(){
	if($_GET['type']=='video')
		echo "class='active'";
}
function literature_sub(){
	if($_GET['type']=='literature')
		echo "class='active'";
}

?>
