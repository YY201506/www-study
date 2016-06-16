/**
 * Created by Administrator on 2016/4/7.
 */
$(".iconsx").click(function () {
    if ($(".barleft").css("width") == "180px") {
        if ($(".bar1").css("width") == "180px") {
            $(".bar1").animate({'width': '50px'}, 300);
            $(".barright").animate({'margin-left': '230px'}, 300);
        } else {
            $(".bar1").animate({'width': '180px'}, 300);
            $(".barright").animate({'margin-left': '360px'}, 300);
        }
    } else {
        if ($(".bar1").css("width") == "180px") {
            $(".bar1").animate({'width': '50px'}, 300);
            $(".barright").animate({'margin-left': '70px'}, 300);
        } else {
            $(".bar1").animate({'width': '180px'}, 300);
            $(".barright").animate({'margin-left': '200px'}, 300);
        }
    }
});

$(".bashou").click(function () {
    if ($(".bar1").css("width") == "180px") {
        if ($(".barleft").css("width") == "180px") {
            $(".barleft").animate({'width': '20px'}, 300);
            $(".barright").animate({'margin-left': '200px'}, 300);
        } else {
            $(".barleft").animate({'width': '180px'}, 300);
            $(".barright").animate({'margin-left': '360px'}, 300);
        }
    } else {
        if ($(".barleft").css("width") == "180px") {
            $(".barleft").animate({'width': '20px'}, 300);
            $(".barright").animate({'margin-left': '70px'}, 300);
        } else {
            $(".barleft").animate({'width': '180px'}, 300);
            $(".barright").animate({'margin-left': '230px'}, 300);
        }
    }
});

$(".line1").click(function () {
    $(this).next().slideToggle(300);
});

$(".padbottom li").click(function(){
    $(".padbottom li").removeClass("changbg")
    $(this).addClass("changbg");
});
 $(".list2 li").click(function(){
     $(".list2 li").removeClass("changebg2")
     $(this).addClass("changebg2");
 });
$(".morespan").click(function(){
    $(".area_hide").slideToggle(300,function(){
        if($(".area_hide").is(':hidden')){
            $(".morespan").html('更多选项<span class="glyphicon glyphicon-triangle-bottom"></span>');
        }else {
            $(".morespan").html('收起选项<span class="glyphicon glyphicon-triangle-top"></span>');
        }

    });
});

$('.form_date').datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
$('#myTab li:eq(0) a').tab('show');


/*$(".bs-example-modal-lg").on("hidden.bs.modal", function() {
 $(this).removeData("bs.modal");
 });
 */
/*$('.bs-example-modal-sm').on('hidden.bs.modal', function () {
    btn.button("reset");
});*/

$("#distribute_btn").click(function(){
    if(globalnum==0){
        $('#myModal2').modal('show');
    }else {
        var arrList = [];
        var i=0;
        var html='';
        $(".box :checkbox").each(function() {
            if ($(this).prop("checked")) {
                arrList[i]=$(this).val();
                i++;
                console.log(arrList);
            }
        });
        for(var i=0;i<arrList.length;i++){
            html +='<li class="list-group-item"><span class="chkname">'+arrList[i]+'</span><button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>';
            console.log(length);
        }
        $(".namelist").html(html);
        $('#myModal1').modal('show');
    }
    $(".namelist li button").click(function(){
        $(this).parent().remove();
    });
});

$("#date1").datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
$("#date2").datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
var chknum = $(".box :checkbox").size();
var globalnum=0;
$(".all").click(function(){
    if(this.checked){
        $(".box :checkbox").prop("checked", true);
        $(".num").html(chknum);
        globalnum=chknum;
    }else{
        $(".box :checkbox").prop("checked",false);
        $(".num").html(0);
        globalnum=0;
    }
});
$(".box :checkbox").click(function(){
    var chk = 0;
    $(".box :checkbox").each(function(){
        if($(this).prop("checked")){
            chk++;
        }
    });
    if(chknum==chk){
        $(".all").attr("checked",true);
    }else{
        $(".all").attr("checked",false);
    }
    $(".num").html(chk);
    globalnum=chk;
});
/*reserve*/
$("#date3").datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
$("#date4").datetimepicker({
    language: 'zh-CN',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
/*reserve*/

/*add*/
$('.other').change(function () {
    if ($(".other").val() == -2) {
        $(".optionfill").show();
    }
})
/*add*/
