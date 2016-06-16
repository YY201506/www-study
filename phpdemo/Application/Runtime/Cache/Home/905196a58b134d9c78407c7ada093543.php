<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo ($item["name"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no, email=no"/>
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
    <link rel="stylesheet" href="/phpdemo/Public/CSS_js/swiper.min.css"/>
    <link rel="stylesheet" href="/phpdemo/Public/CSS_js/help.css"/>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="/phpdemo/Public/CSS_js/swiper-3.3.0.jquery.min.js"></script>
</head>
<body>

    <div class="head"><img class="logo" src="/phpdemo/Public/Image/logo.gif"/><?php echo ($item["name"]); ?> <a href="/phpdemo/Home/Search" style="position: absolute;right: 0.13rem;height:0.5rem;"/><img style="width: 0.3rem;padding-top: 0.09rem;" src="/phpdemo/Public/Image/icon/iconfont-iconfontsousuo.png"/></a></div>
 

    <div class="nav clearfix">
        <a href="/phpdemo/index.php/Home/Learn/index/id/1">常识</a><span>|</span>
        <a href="/phpdemo/index.php/Home/Learn/index/id/2">课程</a><span>|</span>
        <a href="/phpdemo/index.php/Home/Learn/index/id/3">案例</a>

    </div>
<script type="text/javascript">
    var eQ=<?php echo ($item["item"]); ?>-1;
    $(".nav a").eq(eQ).addClass("linkactive");
    $(".nav a").click(function(){
        $(".nav a").removeClass("linkactive");
        $(this).addClass("linkactive");
    });
</script>
<?php if($item["item"] == 1): ?><div class="banner">
         <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="/phpdemo/Public/Image/n1.jpg"></div>
                <div class="swiper-slide"><img src="/phpdemo/Public/Image/n2.jpg"></div>
                <div class="swiper-slide"><img src="/phpdemo/Public/Image/n3.jpg"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
</div>
<script>
        var mySwiper = new Swiper('.swiper-container', {
            autoplay: 5000,
            freeMode : false,
            loop : false,
            pagination : '.swiper-pagination',
            touchRatio : 1,
            preloadImages:false,
            paginationType : 'bullets'
        });
    </script>
    <div class="block1">
        <div class="title"><?php echo ($item["item_name"]); ?></div>

        <?php if(is_array($block)): foreach($block as $key=>$vo): ?><a href="/phpdemo/Home/Learn/course/item/<?php echo ($vo["item"]); ?>/id/<?php echo ($vo["learn_id"]); ?>"><img src="/phpdemo/Public/Image/icon/<?php echo ($vo["url"]); ?>"/><?php echo ($vo["img_name"]); ?></a><?php endforeach; endif; ?>
    </div>

    <?php elseif($item["item"] == 2): ?>
        
<div class="train">
    <?php if(is_array($block)): foreach($block as $key=>$vo): ?><div class="room">
            <a href="/phpdemo/Home/Learn/course/item/<?php echo ($vo["item"]); ?>/id/<?php echo ($vo["learn_id"]); ?>">
                <img src="/phpdemo/Public/Image/<?php echo ($vo["url"]); ?>" class="pic"/>
                <div class="divr"><span><?php echo ($vo["img_name"]); ?></span><span class="time"><?php echo ($vo["creattime"]); ?></span></div></a>
        </div><?php endforeach; endif; ?>

</div>

<!--
// 假设 "video" 就是这个视频元素
var i = setInterval(function() {
	if(video.readyState > 0) {
		var minutes = parseInt(video.duration / 60, 10);
		var seconds = video.duration % 60;

		// (Put the minutes and seconds in the display)

		clearInterval(i);
	}
}, 200);
-->

    <?php elseif($item["item"] == 4): ?>
    
<div class="test">
    <?php if(is_array($block)): foreach($block as $key=>$vo): ?><div class="testroom">
            <a href="/phpdemo/Home/Learn/course/item/<?php echo ($vo["item"]); ?>/id/<?php echo ($vo["learn_id"]); ?>">
                <img src="/phpdemo/Public/Image/icon/<?php echo ($vo["url"]); ?>" class="pic"/>
                <div class="divr"><span><?php echo ($vo["img_name"]); ?></span></div></a>
        </div><?php endforeach; endif; ?>

</div>


    <?php else: ?> 
<div class="list">
    <?php if(is_array($block)): foreach($block as $key=>$vo): ?><div class="case-room">
            <a href="/phpdemo/Home/Learn/course/item/<?php echo ($vo["item"]); ?>/id/<?php echo ($vo["learn_id"]); ?>">
                <p><?php echo ($vo["img_name"]); ?></p>
                <div class="case-detail"><?php echo ($vo["analysis"]); ?></div>
                <img class="credit" src="/phpdemo/Public/Image/credit.png"/>
            </a>
        </div><?php endforeach; endif; ?>

</div>
<script>
    $(".case-detail").each(function(){
        var maxwidth=45;
        if($(this).text().length>maxwidth){
            $(this).text($(this).text().substring(0,maxwidth));
            $(this).html($(this).html()+'…');
        }
    });
</script><?php endif; ?>


</body>
</html>