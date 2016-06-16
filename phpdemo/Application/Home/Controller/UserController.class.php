<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	
    }
    public function login(){
    	$this->display();
    }
    public function checklog(){
        if(empty($_POST['email'])){
            $this->error("空");
        }else{
    	if (isset($_POST['email'])) {
    		$name=$_POST['email'];
    	}
    	$pwd = $_POST['pwd'];
    	$m = M("user");
    	$msg = $m->where("name = '$name'")->find();
    	if($msg['pwd']==$pwd){
    		cookie("usename",$name);
            //setcookie("usename",$name);
    		$this->success("成功！",__APP__."/Home/Board/index");
    	}else{
    		$this->error("密码错误！");
    	}
      }
    }
    public function reg(){
    	$this->display();
    }
    public function checkreg(){
        if(empty($_POST["email"])){
             $this->error("空");
        }else{
    	$data['name']=$_POST['email'];
        $data['pwd']=$_POST['pwd'];

        $m=M("user");
        $msg=$m->create($data);
        $result=$m->add();
        if($result == true){
        	cookie("usename",$data['name']);
            //setcookie("usename",$data['name']);
        	$this->success("注册成功",__APP__."/Home/Board/index");
        }else{
        	$this->error("失败");
        }
        }
    }
    public function logout(){
        cookie("usename",null);
        $this->success("注销成功");
    }
  
}