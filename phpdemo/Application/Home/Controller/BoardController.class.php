<?php
namespace Home\Controller;
use Think\Controller;
class BoardController extends Controller {
    public function index(){
    	$m=M("board");
        $msg=$m->where()->select();
        $this->assign('boarder',$msg);
        $this->display();
    }
    public function addmsg(){
    	$m=M("board");
        $data = array();
        $data[] = array('name' => 'asss');
        $data[] = array('name' => 'badjd');
        $data[] = array('name' => 'cadaeae');
        $data[] = array('name' => 'defj fk');
        $data[] = array('name' => 'efw');
        $m->addAll($data);
        echo "导入完毕";
    }
    public function postmsg(){
        $m=M("post");
        $data = array();
        $data[] = array('board' => 1 ,'text'=>'睡觉阿迪和','author'=>'shd@di.com');
        $data[] = array('board' => 1 ,'text'=>'睡觉是额忘记','author'=>'sh5@diy.com');
        $data[] = array('board' => 1 ,'text'=>'黑色的复合额忘记','author'=>'sesh5@diey.com');
        $data[] = array('board' => 1 ,'text'=>'黑色的和雕塑复合额忘记','author'=>'erh5@diey.com');
        $m->addAll($data);
        echo "导入完毕";
    }
     public function detail($id){
        $m=M("board");
        $id=intval($id);
        $board=$m->where("id=$id")->select();
        $this->assign('board',$board[0]);
        $n=M("post");

        $count=$n->where("board=$id")->count();
        $page=new \Think\Page($count,8);
        $show=$page->show();
        $post=$n->where("board =$id")->limit($page->firstRow.','.$page->listRows)->select();
        //$post=$n->where("board= $id")->select();
        $this->assign('post',$post);
        $this->assign('page',$show);
        $this->display();
     }

}