<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>
        <?php if($course["item"] == 3): ?>案例中心
            <?php else: echo ($course["img_name"]); endif; ?>
    </title>
    <link rel="stylesheet" href="/phpdemo/Public/CSS_js/help.css"/>
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
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>

<div class="head1"><a href="#" onclick="window.history.back(); return false;"><img class="goback" src="/phpdemo/Public/Image/icon/houtui.png"/></a>
    <?php if($course["item"] == 3): ?>案例中心
        <?php else: echo ($course["img_name"]); endif; ?>
</div>


<?php if($course["video"] == 1): ?><div class="course" id="course">
    <div class="media" style="background: #15191F;height: 2.1rem;">
           <video id="video" preload="meta" loop="loop" width="100%" height="100%" name="media">
           <source src="<?php echo ($course["media"]); ?>" type="video/ogg;codecs="theora,vorbis"" media="screen" />
           <source src="<?php echo ($course["media"]); ?>"  />
           </video>
        </div>
</div>


<script type="text/javascript">
var myVideo=document.getElementById("video");
    myVideo.poster = "<?php echo ($course["poster"]); ?>";
    var playstatue = false;
    function control() {
        if (playstatue) {
            myVideo.pause();
            console.log("停");
            playstatue = false;
        } else {
            myVideo.play();
            console.log("开");
            playstatue = true;
        }
    }
    $("#video").on("click",control);
</script>

    <?php elseif($course["item"] == 3): ?>
        <div class="page">
    <h4><?php echo ($course["img_name"]); ?></h4>
    <p class="date"><?php echo ($course["date"]); ?></p>

    <div class="page-p">
        <?php echo file_get_contents($file); ?>
    </div>
    <p class="title orange">专家分析</p>
    <div class="analys"><?php echo ($course["analysis"]); ?></div>
</div>
    <?php elseif($course["item"] == 4): ?>
        
<div class="test">
    <?php if(is_array($block)): foreach($block as $key=>$vo): ?><div class="testroom">
            <a href="/phpdemo/Home/Learn/course/item/<?php echo ($vo["item"]); ?>/id/<?php echo ($vo["learn_id"]); ?>">
                <img src="/phpdemo/Public/Image/icon/<?php echo ($vo["url"]); ?>" class="pic"/>
                <div class="divr"><span><?php echo ($vo["img_name"]); ?></span></div></a>
        </div><?php endforeach; endif; ?>

</div>

    <?php else: ?>
        
<!-- <div class="artical">
        <img src="/phpdemo/Public/Image/c1.jpg"/>
        <p class="lh"><span class="atitle">按压方法</span>用掌根重叠放在另一手背上使手指脱离胸壁，可采用两手指交叉抬起法。
            抢救者双臂应绷直，双肩在患者胸骨上方正中，垂直向下按压，按压力量应足以使胸骨下沉至少5 cm，压下后即放开，但双手不应离开胸壁，使胸骨自行弹回原位，如此反复操作。
            注重每次按压后使胸廓回弹恢复原状，尽量避免按压中断。</p>
        <p class="lh"> 按压方法：用掌根重叠放在另一手背上使手指脱离胸壁，可采用两手指交叉抬起法。</p>
        <img src="/phpdemo/Public/Image/c1.jpg"/>
    </div>-->
<script type="text/javascript">
    var art=[
            <?php if(is_array($artical)): foreach($artical as $key=>$vo): ?>{imgsrc:"<?php echo ($vo["img"]); ?>",atitle:"<?php echo ($vo["atitle"]); ?>",p:"<?php echo ($vo["p"]); ?>"},<?php endforeach; endif; ?>
    ];
    setartical(art);
    function setartical(arctical){
        var content='';
        for(var i=0;i<arctical.length;i++){
            if(arctical[i].imgsrc!==""){
                content+='<img src="/phpdemo/Public/Image/'+arctical[i].imgsrc+'"/>';
            }
            if(arctical[i].atitle!==""){
                content+='<p class="lh"><span class="atitle">'+arctical[i].atitle+'</span>'+arctical[i].p+'</p>';
            }
            if(arctical[i].p!==""){
                content+='<p class="lh">'+arctical[i].p+'</p>';
            }else {
                content+='';
            }
        }
        var add_act = document.createElement('div');
        add_act.id="artical";
        add_act.innerHTML = content;
        document.body.appendChild(add_act);
    }
</script><?php endif; ?>

<script type="text/javascript">
    var arryDetail=[
            <?php if(is_array($q)): foreach($q as $key=>$vo): ?>{page:"<?php echo ($vo["page"]); ?>",detail:"<?php echo ($vo["detail"]); ?>",tel:<?php echo ($vo["tel"]); ?>},<?php endforeach; endif; ?>
    ];

    setstep(arryDetail);
    function setstep(arryDetail){
        if(arryDetail.length >=1){
            var content='';
            var number=1;
            for(var i=0;i<arryDetail.length;i++){
                content +='<div class="part clearfix"><div class="num left">'+number+'</div>';
                if(!arryDetail[i].detail&&!arryDetail[i].tel){
                    content +='<div class="buzou left"><p style="margin-top: 0.1rem">'+arryDetail[i].page+'</p></div></div>';
                    console.log(i);
                    console.log(arryDetail[i].detail);
                    console.log(arryDetail[i].tel);
                }else{
                    content +='<div class="buzou left"><p>'+arryDetail[i].page+'</p>';
                    if(arryDetail[i].detail){
                        content+='<p class="gray">'+arryDetail[i].detail+'</p></div></div>';
                    }else if(arryDetail[i].tel){
                        content+='<a href="tel:120">拨打120</a></div></div>';
                    }else{
                        content+='</div></div>';
                    }
                }
                number++
            }
            var add_step = document.createElement('div');
            add_step.id="crowd";
            add_step.innerHTML = content;
            document.body.appendChild(add_step);
        }else{
            console.log("没步骤！");
        }
    }


    var arg1 = [
            <?php if(is_array($q)): foreach($q as $key=>$vo): ?>{question:"<?php echo ($vo["question"]); ?>",answer:"<?php echo ($vo["answer"]); ?>"},<?php endforeach; endif; ?>
    ];

    addproblem(arg1);
    function addproblem(obj){
        if(obj.length>=1){
            if(obj[0].question!==""){
                var content='';
                content +='<div class="title">常见问题</div>';
                for(var i=0;i<obj.length;i++){
                    content +='<div class="pro"><h4>'+obj[i].question+'</h4><p class="gray">'+obj[i].answer+'</p></div>';}

                var add_problem = document.createElement('div');
                add_problem.id="problem";
                add_problem.innerHTML = content;
                document.body.appendChild(add_problem);
            }else{
                console.log("没问题！");
            }
        }else{
            console.log("没问题！");
        }


    }

    $(".pro").each(function(index){
        $(this).click(function(){
            $(".pro").eq(index).find("p").slideToggle(50);
        });
    });
</script>
</body>
</html>