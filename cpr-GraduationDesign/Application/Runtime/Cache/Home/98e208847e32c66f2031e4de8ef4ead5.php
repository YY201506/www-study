<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>搜索</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no, email=no"/>
    <link rel="stylesheet" href="/phpdemo/Public/CSS_js/help.css"/>

    <script type="text/javascript">
        (function (e, a) {
            function f() {
                return parseFloat(e.getComputedStyle(a.documentElement, null)["font-size"])
            }

            function g() {
                if (d) {
                    var b = a.documentElement.offsetWidth;
                    if (d != b) {
                        var c = a.createElement("style");
                        c.innerHTML = "@media only screen and (width: " + b + "px) {html{font-size: " + 200 / 750 * b + "px !important;}}";
                        a.getElementsByTagName("head")[0].appendChild(c);
                        e.removeEventListener("orientationchange", orientationchange)
                    }
                } else d = a.documentElement.offsetWidth, a.documentElement.style.fontSize = 200 / 750 * d + "px", b = f(),
                        c = 200 / 750 * d, b !== c && (b > c + 1 || b < c - 1) && (a.documentElement.style.fontSize = "200px", a.documentElement.style.fontSize = 200 / f() * c + "px")
            }

            var d;
            g();
            0 > e.navigator.userAgent.indexOf("iPhone") && e.addEventListener("orientationchange", function () {
                setTimeout(function () {
                    g()
                }, 300)
            })
        })(window, document);
    </script>
</head>
<body>
<div class="head1"><a href="#"  onclick="window.history.back(); return false;"><img class="goback"  src="/phpdemo/Public/Image/icon/houtui.png"/></a>
    <div class="search"><input type="text" size=14 id="course" value=""><span id="search_btn">搜索</span></div>
</div>
<div class="block2">
</div>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">
        $(".block2").hide();
        var $search=$('#course');
        $search.focus();
        function result(obj){
            var res='';
            res+='<div class="gray_title">相关课程</div>';
            if(obj.length>=1){
                for(var i=0;i<obj.length;i++){
                    res+='<a href="'+obj[i].href+'">'+obj[i].name+'</a>';
                }
            }else{
                res+='无';
            }
            $(".block2").append(res);
        }
        $("#search_btn").click(function(){   
            if($("#course").val()=="")
            {
                alert('请输入文字!');
                $(".block2").empty();
                $search.focus();
                //return false;
            }else{
                $.post("/phpdemo/Home/Search/checksearch",
                      {
                        course:$("#course").val()
                      },
                      function(data,status){
                        $(".block2").empty();
                        console.log("Status: " + status+"\ndata:"+data);
                        
                        var res='';
                        res+='<div class="gray_title">相关课程</div>';
                        if(data.length>=1){
                            for(var i=0;i<data.length;i++){
                                res+='<a href="/phpdemo/Home/Learn/course/item/'+data[i].item+'/id/'+data[i].learn_id+'">'+data[i].img_name+'</a>';
                            }
                        }else{
                            res+='无';
                        }
                        $(".block2").append(res);
                        $(".block2").show();
                   },'json');
        }
    });
</script>
</body>
</html>