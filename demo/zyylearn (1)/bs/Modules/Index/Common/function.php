<?php
function test(){
echo "独立分组的函数库要命名成function.php,否则不加载";
}

//返回前端导航公共部分
function sub(){
	$string=U('','','');
	$arr=preg_split("/[\s,\/!]+/", $string);
	$indexUrl=U('Index/Index/index');
	$exchaUrl=U('Index/Exchange/index');
	$courcUrl=U('Index/Cource/index');
	$selheUrl=U('Index/Self_help/index');
	$olineUrl=U('Index/Online_text/index');
	$teachUrl=U('Index/Teach/index');

	$substring="<li><a href='".$indexUrl."'"; if($arr[2]=="Index"){$substring=$substring." class='"."current'";}
		$substring=$substring.">首页</a></li>
		<li><a href='".$exchaUrl."?list=all'"; if($arr[2]=="Exchange"){$substring=$substring." class='"."current'";}
		$substring=$substring.">交流互助</a></li>
		<li><a href='".$courcUrl."'"; if($arr[2]=="Cource"){$substring=$substring." class='"."current'";}
		$substring=$substring.">课程资源</a></li>
		<li><a href='".$selheUrl."'"; if($arr[2]=="Self_help"){$substring=$substring." class='"."current'";}
		$substring=$substring.">自助答疑</a></li>
		<li><a href='".$olineUrl."'"; if($arr[2]=="Online_text"){$substring=$substring." class='"."current'";}
		$substring=$substring.">在线测试</a></li>
		<li><a href='".$teachUrl."'"; if($arr[2]=="Teach"){$substring=$substring." class='"."current'";}
	$substring=$substring.">导师导学</a></li>";
	return $substring; 
}


//资源下载的函数
function download($file_dir,$file_name)
//参数说明：
//file_dir:文件所在目录
//file_name:文件名
{
//		echo $file_dir."<br>".$file_name."<br>";
		//	die;
    $file_dir = chop($file_dir);//去掉路径中多余的空格
    //得出要下载的文件的路径
    if($file_dir != '')
    {
        $file_path = $file_dir;
        if(substr($file_dir,strlen($file_dir)-1,strlen($file_dir)) != '/')
            $file_path .= '/';
        $file_path .= $file_name;
    }           
    else
        $file_path = $file_name;   
	//echo $file_path."<br>";
	//判断要下载的文件是否存在
	$file_path=$_SERVER["DOCUMENT_ROOT"].$file_path;//重置文档的路径为当前服务器中的绝对路径
    if(!file_exists($file_path))
	{
        echo 'Sorry,the file not exist!';
        return false;
    }
    $file_size = filesize($file_path);

    header("Content-type: application/octet-stream");
    header("Accept-Ranges: bytes");
    header("Accept-Length: $file_size");
    header("Content-Disposition: attachment; filename=".$file_name);
   
    $fp = fopen($file_path,"r");
    $buffer_size = 1024;
    $cur_pos = 0;
   
    while(!feof($fp)&&$file_size-$cur_pos>$buffer_size)
    {
        $buffer = fread($fp,$buffer_size);
        echo $buffer;
        $cur_pos += $buffer_size;
    }
   
    $buffer = fread($fp,$file_size-$cur_pos);
    echo $buffer;
	fclose($fp);
    return true;
}


//注册的函数
function regist($name,$passwd){
	$student=M('student');
	$data['UserName']=$name;
	$data['UserPasswd']=$passwd;
	$status=$student->add($data);//返回最后的行数
	if($status){
		session('login',$name);	
		return 1;
	}else{
		return 0;
	}

}
	//动态返回话题样式
	
	function t_sub(){
			if($_GET['name']=='my')	
					echo "class='active'";
	}

	//根据已解决的问题标题id去找到答案，并返回答案和问题的重组数组

	function QA($q_list){
					$i=0;
				foreach($q_list as $question){
						//p($question);
						$result[$i]['answer']=M('answer')->where("Qid=".$question['Qid']." and Acontent != ''")->field('Acontent,Ateacher')->select();
						$result[$i]['question']=$question['Qcontent'];
						$result[$i]['title']=$question['Qtitle'];
						$i=$i+1;
				}
					return $result;
	}
?>
