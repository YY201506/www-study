/**
 * Created by Administrator on 2015/12/4.
 */

var defaults = {
    "id": "#wrap1",
    "width": "900",
    "height": "500",
    "list": ['wsj.jpg', 'kt.jpg', 'zw.jpg', 'cf.jpg', 'ct.jpg', 'etf.jpg'],
    "callback":function(index){
        console.log(index);
    }
};

var banner1 = new fullbanner(defaults);

function fullbanner(obj) {
    obj.width = obj.width || 900;
    obj.height = obj.height || 500;

    $(obj.id).css({"width":"100%","height":obj.height,"min-width":obj.width});

    var main = '';
    main = '<div class="base-slide" style="width:'+obj.width+'px;margin-left: '+(obj.width/2)+'px"><div class="base-temp" style="width:'+obj.width+'px;"><div class="button_pre" style="margin-left:-'+(obj.width-3)+'px "></div><div class="button_next"></div><div class="temp-wrap" style="left: 0px;"><ul id="img_con" class="clearfix" style="left:-'+obj.width+'px;margin-left:-'+obj.width+'px!important;">';
    for (var i = 0; i < obj.list.length; i++) {
        main += '<li style="width: '+obj.width+'px;height: '+obj.height+'px;" ret="'+i+' "><img src="' + obj.list[i] +'"/></li>';
    }
    main += '</ul></div></div></div><div class="pnBtn prev" style="margin-left: -'+(obj.width/2)+'px;height: '+(obj.height-7)+'px;"><span class="blackBg" style="height: '+obj.height+'px;"></span></div><div class="pnBtn next" style="margin-left:'+(obj.width/2)+'px;height:'+(obj.height-7)+'px"><span class="blackBg" style="height: '+obj.height+'px;"></span></div>';
    $(obj.id).append(main);


    $(obj.id +" .button_next").click(function () {
        $(".temp-wrap").animate({left: "-" + obj.width + "px"}, function () {
            $arr = $(".temp-wrap").find("ul li").get(0);
            $arr.remove();
            $(".temp-wrap ul").append($arr);
            $(".temp-wrap").css("left", "0px");
            if(obj.callback != undefined){
              obj.callback($("li:eq(1)").attr('ret'));
            }
        });
    });
    $(obj.id + " .button_pre").click(function () {
        $(obj.id + " .temp-wrap").css("left", "-" + obj.width + "px");
        $arr = $(obj.id + " .temp-wrap").find("ul li").get(i-1);
        $arr.remove();
        $(obj.id + " .temp-wrap ul").prepend($arr);
        $(obj.id + " .temp-wrap").animate({left: "0px"});
        if(obj.callback != undefined){
           obj.callback($("li:eq(1)").attr('ret'));
        }
    });

}


