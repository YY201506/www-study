/**
 * Created by Administrator on 2015/12/4.
 */
$(document).ready(function () {
    var srcimg = new Array("wsj.jpg", "kt.jpg", "zw.jpg", "cf.jpg", "ct.jpg", "etf.jpg");
    var num = srcimg.length + 1;

    var main='';
    main="<div class='base-slide'><div class='base-temp'><div class='button_pre'></div><div class='button_next'></div><div class='temp-wrap' style='left: 0px;'><ul id='img_con' class='clearfix'></ul></div></div></div><div class='pnBtn prev'><span class='blackBg'></span></div><div class='pnBtn next'><span class='blackBg'></span></div>";
    $(".config-slide-wrap").append(main);

    for (var i = 1; i < num; i++) {
        $("<li><img src=''/></li>").appendTo("#img_con");
    }

    var List = $("li");
    List.each(function (index) {
        $(this).addClass("pic");
        $(this).addClass("pic" + index);
    });

    $(".pic img").each(function(index){
        $(this).attr("src",srcimg[index])
    });

    $(".button_next").click(function () {
        $(".temp-wrap").animate({left: "-900px"}, function () {
            $arr = $(".temp-wrap").find("ul li").get(0);
            $arr.remove();
            $(".temp-wrap ul").append($arr);
            $(".temp-wrap").css("left", "0px");
        });
    });

    $(".button_pre").click(function () {
        $(".temp-wrap").css("left", "-900px");
        $arr = $(".temp-wrap").find("ul li").get(5);
        $arr.remove();
        $(".temp-wrap ul").prepend($arr);
        $(".temp-wrap").animate({left: "0px"});
    });

});
