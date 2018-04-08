/**
 * 用于客户端前台的footer定位
 * */
var nowDate = new Date();
document.getElementById("nowYear").innerHTML = nowDate.getFullYear();
document.getElementById('lastYear').innerHTML = nowDate.getFullYear() - 1 ;
window.onload = position;
//定位footer位置
function position(){
	if(document.documentElement.clientHeight > document.documentElement.offsetHeight-4){	//减4是因为浏览器的边框是2像素, 否则会一直判断有滚动条 
		$('.footer').css({'position': 'absolute', 'bottom': '0px','padding':'10px','text-align':'center','background-color':'#222222;','color':'#FFFFFF','width':'100%'});
	}else{
		$('.footer').css({'position': '','padding':'10px','text-align':'center','background-color':'#222222;','color':'#FFFFFF','width':'100%'});
	}
}
window.onresize = function(){
	position();
}