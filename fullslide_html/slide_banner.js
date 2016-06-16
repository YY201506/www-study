/**
 * Created by Administrator on 2015/12/4.
 */

    var defaults = {
         "id":"#wrap1",
        "width": "900",
        "height": "500",
        "list": ['wsj.jpg', 'kt.jpg', 'zw.jpg', 'cf.jpg', 'ct.jpg', 'etf.jpg']
    };

var banner1 = new fullbanner(defaults);

function fullbanner(obj) {
    var main = '';
    main = "<div class='base-slide'><div class='base-temp'><div class='button_pre'></div><div class='button_next'></div><div class='temp-wrap' style='left: 0px;'><ul id='img_con' class='clearfix'>";
    for (var i = 0; i < obj.list.length; i++) {
        main += "<li><img src='" + obj.list[i] + "'/></li>";
    }
    main += "</ul></div></div></div><div class='pnBtn prev'><span class='blackBg'></span></div><div class='pnBtn next'><span class='blackBg'></span></div>";
    $(obj.id).append(main);

    $(obj.id +" .button_next").click(function () {
        $(obj.id +" .temp-wrap").animate({left: "-"+obj.width+"px"}, function () {
            $arr = $(obj.id + " .temp-wrap").find("ul li").get(0);
            $(obj.id +" .temp-wrap").css({left:"0px"});
            $arr.remove();
            $(obj.id + " .temp-wrap ul").append($arr);
            $(obj.id +" .temp-wrap").animate({left: "-"+obj.width+"px"});
        });
    });
    $(obj.id +" .button_pre").click(function () {
        $(obj.id +" .temp-wrap").css("left", "-"+obj.width+"px");
        $arr = $(obj.id +" .temp-wrap").find("ul li").get(5);
        $arr.remove();
        $(obj.id +" .temp-wrap ul").prepend($arr);
        $(obj.id +" .temp-wrap").animate({left: "0px"});
    });

}


