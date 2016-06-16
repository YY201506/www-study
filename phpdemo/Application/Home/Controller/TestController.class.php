<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index(){
    	//$this->assign("name","lmm");
    	/*$data['name'] = "lmm";
    	$data['age'] = 23;
    	$this->assign('data',$data);
        $this->display();*/
    }
    public function show(){
    	$list=array(
    		array("name"=>"mm","age"=>20),
    		array("name"=>"wse","age"=>20));
    	$this->assign("list",$list);
    	$this->display();
    }
}