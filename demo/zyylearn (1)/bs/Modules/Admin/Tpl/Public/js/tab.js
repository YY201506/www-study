window.onload = function(){
	var url = document.location.href; //获取url地址
	turnTab(url);
}

//选项卡切换

function tabChange(name,num,n){
	 for(i=1;i<=n;i++){
	  var menu=document.getElementById(name+i);
	  var content=document.getElementById(name+"_"+"tabTree"+i);
	  menu.className=i==num?"active":"";
		content.style.display=i==num?"block":"none";
	 }
}

//根据hash切换tab
function turnTab(url){
	var hashLink = url.split("#");
	var hashTarget = hashLink[1] || "career"; //获取#后面的hash参数
	var targetParent = "";
	var targetMiddle = "";
	var targetLeft = "";
	var targetChildren = "";
	var targetcomposite = "";
    switch (hashTarget){
    	case 'career':
    		targetParent = "parentTab1";
    		targetChildren = "parentTab_tabTree1";
    		targetcomposite = "tabInner1";
    		targetMiddle = "tabInner_tabTree1";
    		break;
    	case 'market':
    		targetParent = "parentTab1";
    		targetChildren = "parentTab_tabTree1";
    		targetcomposite = "tabInner2";
    		targetMiddle = "tabInner_tabTree2";
    		break;
			
    	case 'sales':
    		targetParent = "parentTab1";
    		targetChildren = "parentTab_tabTree1";
    		targetcomposite = "tabInner3";
    		targetMiddle = "tabInner_tabTree3";
    		break;
			
			
    	case 'web':
    		targetParent = "parentTab2";
    		targetChildren = "parentTab_tabTree2";
    		targetLeft = "tabInner21";
    		targetMiddle = "tabInner2_tabTree1";
    		break;
    	case 'php':
    		targetParent = "parentTab2";
    		targetChildren = "parentTab_tabTree2";
    		targetLeft = "tabInner22";
    		targetMiddle = "tabInner2_tabTree2";
    		break;
		case 'java':
			targetParent = "parentTab2";
			targetChildren = "parentTab_tabTree2";
			targetLeft = "tabInner23";
			targetMiddle = "tabInner2_tabTree3";
			break;
		case 'android':
			targetParent = "parentTab2";
			targetChildren = "parentTab_tabTree2";
			targetLeft = "tabInner24";
			targetMiddle = "tabInner2_tabTree4";
			break;
        case 'design':
        	targetParent = "parentTab3";
            targetChildren = "parentTab_tabTree3";
            break;
        case 'finance':
        	targetParent = "parentTab4";
            targetChildren = "parentTab_tabTree4";
            break;

    }

    var linkArrayParent = [];
	var linkArrayChildren = [];

	for(var i = 1;i <= 4;i++){
		linkArrayChildren[i] = "parentTab_tabTree"+i;
		document.getElementById(linkArrayChildren[i]).style.display = "none";
		
	}
	for(var i = 1;i <= 4;i++){
		linkArrayParent[i] = "parentTab"+i;
		document.getElementById(linkArrayParent[i]).className = "";	
	}

	document.getElementById(targetParent).className = "active";
	document.getElementById(targetChildren).style.display = "block";
	
	if(targetLeft != ""){
		for(var i = 1;i<=3;i++){
			document.getElementById("tabInner2"+i).className = "";		
			document.getElementById("tabInner2_tabTree"+i).style.display = "none";
		}
		document.getElementById(targetLeft).className = "active";		
	    document.getElementById(targetMiddle).style.display = "block";
	}
			
	
	if(targetcomposite != ""){
		for(var i = 1;i<=3;i++){
			document.getElementById("tabInner"+i).className = "";		
			document.getElementById("tabInner_tabTree"+i).style.display = "none";
		}
		document.getElementById(targetcomposite).className = "active";		
	    document.getElementById(targetMiddle).style.display = "block";
	}

}
