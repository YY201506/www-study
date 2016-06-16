<?php
namespace Home\Controller;
use Think\Controller;
class DBController extends Controller {
    public function index(){
    	$m=M("user");
        $data=$m->find();
        var_dump($data);
    }
    public function create(){
        $m=M("user");
        $data['name']="gfg";
        $data['id']="2";
        $data['pwd']=md5('lin');
        $m->create($data);
        $m->add();
    }
  
}