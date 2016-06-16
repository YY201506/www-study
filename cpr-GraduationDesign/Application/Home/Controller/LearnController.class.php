<?php
namespace Home\Controller;
use Think\Controller;
class LearnController extends Controller {
    public function index($id){
        $m=M("learn");
        $id=intval($id);
        $item=$m->where("item=$id")->select();
        $this->assign('item',$item[0]);
        $n=M("learn_item$id");
        $msg=$n->where("item=$id")->select();
        $this->assign('block',$msg);
        $this->display();
    }
    public function course($item,$id){
        $m=M("learn_item$item");
        $course=$m->where("item = $item and learn_id=$id")->select();
        $this->assign('course',$course[0]);
        $file='Public/page/'.$course[0][pagesrc];
        $this->assign('file',$file);

        $nn=M("learn_course1");
        $map['item'] = $item;
        $map['learn_id'] = $id;
        $q=$nn->where($map)->select();
        /*$nn->fetchSql(true)->where("item = $item and learn_id = $id")->select();*/
        $this->assign('q',$q);

        $art=M("artical");
        $artical=$art->where($map)->select();
        $this->assign('artical',$artical);
        $this->display();
    }

     public function itemmsg(){
        $m=M("learn_item1");
        $data = array();
/*        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"气道哽塞",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"糖尿病急症",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"颅脑外伤",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"中毒",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"休克",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"拉伤、扭伤",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
        $data[] = array('learn_id'=>'','url'=>'logoff.png','img_name'=>"中风",'media'=>'http://vss2.waqu.com/j27cxl9yw7o4qcey/normal.mp4','poster'=>'http://img.waqu.com/j27cxl9yw7o4qcey/thumbnail/0033.jpg');
*/        
        $m->addAll($data);
        echo "导入完毕";
    }


}