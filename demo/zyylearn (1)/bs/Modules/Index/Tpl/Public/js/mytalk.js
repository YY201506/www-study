/*点击我发起的话题时，判断是否登录*/
var Mysession="{:session('login')}";
$(document).ready(function(){
    $("#my").click(function(){
       if(Mysession==''){
        alert("你要先登录才能查看你发起的话题喔！");
       }else{
        location.href="{:U('Index/Exchange/index')}";
       }
    });
});