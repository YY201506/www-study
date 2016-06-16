<?php
namespace Home\Controller;
use Think\Controller;
class MmerController extends Controller {
    public function index(){
        $this->show("哈哈");
    }
    public function show($name,$age){
    	var_dump($_GET);
    	echo "我叫：$name","年龄：$age";
    }
    
}