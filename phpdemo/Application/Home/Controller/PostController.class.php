<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {
    public function index($id){
    	$m = M("post");
        $owner = $m->where("own = 0 and id= $id")->find();
        $this->assign('owner',$owner);
        $count = $m->where("own = $id")->count();
        $page = new \Think\Page($count,4);
        $show = $page->show();
        $post = $m->where("own = $id")->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('post',$post);
        $this->assign('page',$show);
        $this->display();

    }
    public function addpost($id){
        $m=M("post");
        $data = array();
        $data[] = array('board'=>1,'text'=>'扫地机his打算尽快','own'=>$id,'author'=>'shd@sad.com');
        $data[] = array('board'=>1,'text'=>'扫丹佛掘金看电视是大家分开尽快','own'=>$id,'author'=>'shd@sad.com');
        $data[] = array('board'=>1,'text'=>'扫地机撒大家看打算尽快','own'=>$id,'author'=>'shd@sad.com');
        $data[] = array('board'=>1,'text'=>'扫额日开始的风景儿科尽快','own'=>$id,'author'=>'shd@sad.com');
        $m->addAll($data);
        echo "导入完毕";
    }
    public function add(){
        $m=M("post");
        $data=array();
        $data['own']=isset($_POST['alone'])?0:$_POST['own'];
        $data['board']=$_POST['board'];
        $data['text']=$_POST['text'];
        if(cookie('usename')){
            $data['author']=cookie('usename');
        }else{
            $data['author']='匿名';
        }
        $m->create($data);
        $re=$m->add();
        if($re){
            $this->success("发表成功");
        }else{
            $this->error("发表错误");
        }
    }

}