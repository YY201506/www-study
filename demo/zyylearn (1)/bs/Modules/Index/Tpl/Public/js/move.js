function getStyle(obj, name)
{
	if(obj.currentStyle)
	{
		return obj.currentStyle[name];
	}
	else
	{
		return getComputedStyle(obj, false)[name];
	}
}


//startMove(oDiv, {width: 400, height: 400})


function startMove(obj, json, fnEnd)
{
	clearInterval(obj.timer);
	obj.timer=setInterval(function (){
		var bStop=true;		//假设：所有值都已经到了
		
		for(var attr in json)
		{
			var cur=0;
			
			if(attr=='opacity')
			{
				cur=Math.round(parseFloat(getStyle(obj, attr))*100);
			}
			else
			{
				cur=parseInt(getStyle(obj, attr));
			}
			
			var speed=(json[attr]-cur)/6;
			speed=speed>0?Math.ceil(speed):Math.floor(speed);
			
			if(cur!=json[attr])
				bStop=false;
			
			if(attr=='opacity')
			{
				obj.style.filter='alpha(opacity:'+(cur+speed)+')';
				obj.style.opacity=(cur+speed)/100;
			}
			else
			{
				obj.style[attr]=cur+speed+'px';
			}
		}
		
		if(bStop)
		{
			clearInterval(obj.timer);
						
			if(fnEnd)fnEnd();
		}
	}, 30);
}



		function getByClass(oParent, sClass)
{
	var aEle=oParent.getElementsByTagName('*');
	var aResult=[];
	
	for(var i=0;i<aEle.length;i++)
	{
		if(aEle[i].className==sClass)
		{
			aResult.push(aEle[i]);
		}
	}
	
	return aResult;
}
window.onload=function(){
	
	var oPlay=document.getElementById('play_images');
	var aLi=oPlay.getElementsByTagName('li');
	var aDiv=oPlay.getElementsByTagName('div');
	var oBtnPrev=getByClass(oPlay, 'prev')[0];
	var oBtnNext=getByClass(oPlay, 'next')[0];
	//var nowZIndex=4;
	var now=0;
	function tab()
	{
		//aLi[now].style.zIndex=nowZIndex++;
		for(var i=0;i<aLi.length;i++){
			aLi[i].style.display='none';
		}
		for(var i=0;i<aDiv.length;i++){
			aDiv[i].style.height=0+'px';
			}
		aLi[now].style.display='block';

		aLi[now].style.opacity=0.3;
		aLi[now].style.filter='alpha(opacity:30)';
		startMove(aLi[now],{opacity: 100});
		startMove(aDiv[now],{height:210}); //'opacity', 100
	}
	oBtnNext.onclick=function ()
	{
		now++;
		if(now==aLi.length)
		{
			now=0;
		}
		
		tab();
	};
	oBtnPrev.onclick=function ()
	{
		now--;
		if(now==-1)
		{
			now=aLi.length-1;
		}
		
		tab();
	};
	var timer=setInterval(oBtnNext.onclick, 3000);
	
	oPlay.onmouseover=function ()
	{
		clearInterval(timer);
	};
	oPlay.onmouseout=function ()
	{
		timer=setInterval(oBtnNext.onclick, 3000);
	};
}


	