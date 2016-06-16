<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function index(){

        $this->display();
    }

     public function checksearch(){

        if(empty($_POST["course"])){
             $this->error("空");
        }else{

        $course=$_POST['course'];
        $m1=M("learn_item1");
        $m2=M("learn_item2");
        $m3=M("learn_item3");
        $keywords = '%'.$course.'%';   
        $where['img_name'] = array('like',$keywords);  
        $search1 = $m1->where($where)->select();
        $search2 = $m2->where($where)->select();
        $search3 = $m3->where($where)->select();
        $search = $search1+$search2+$search3;    
        print_r(json_encode($search));
        //$assistList = array();
        //$assistArray = M("learn_item1")->where($where)->select();
        /*foreach ($assistArray as $key => $assistValue) {
                $assistList[$key]['item'] = $assistValue['item'];
                $assistList[$key]['learn_id'] = $assistValue['learn_id'];
                $assistList[$key]['img_name'] = $assistValue['img_name'];
        }*/
         //$this->assign('search',json_encode($assistList));
         //echo $assistList;

       }
    }

}