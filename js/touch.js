// touch.js handles touch input scaling of web pages
function prepareTouch() {
	// Only addEventListener support is implemented due to browsers
	// which support attachEvent only will require touch handling
	if(window.addEventListener) {
		var maincontent=document.getElementById("main");
		if(getCookie('fontsize')!= null) {
			cookiesize=getCookie('fontsize');
			maincontent.style.setProperty("font-size",cookiesize+"px",null);
		}
		var mainstyle=window.getComputedStyle(maincontent);
		var mainfont=mainstyle.getPropertyValue("font-size");
		var previoussize=parseInt(mainfont);
		var sx1,sy1,sx2,sy2,cx1,cy1,cx2,cy2,linestart,linecurrent=0;
		var multitouch=false;
			document.addEventListener('touchstart', function(e) {
			if(e.touches.length>1) {
				multitouch=true;
				mainstyle=window.getComputedStyle(maincontent);
				mainfont=mainstyle.getPropertyValue("font-size");
				previoussize=parseInt(mainfont);
				sx1=e.touches[0].clientX;
				sy1=e.touches[0].clientY;
				sx2=e.touches[1].clientX;
				sy2=e.touches[1].clientY
				linestart=Math.sqrt(Math.pow(Math.abs(sx1-sx2),2)+Math.pow(Math.abs(sy1-sy2),2));
				stopDefaultAction(e);
			}
		},false);
			document.addEventListener('touchmove', function(e) {
			if(e.touches.length>1) {
				cx1=e.changedTouches[0].clientX;
				cy1=e.changedTouches[0].clientY;
				cx2=e.changedTouches[1].clientX;
				cy2=e.changedTouches[1].clientY;
				linecurrent=Math.sqrt(Math.pow(Math.abs(cx1-cx2),2)+Math.pow(Math.abs(cy1-cy2),2));
				linechange=Math.round((linecurrent-linestart)/10);
				newsize=previoussize+linechange;
				if(newsize<6){newsize=6;}
				maincontent.style.setProperty("font-size",newsize+"px",null);
				stopDefaultAction(e);
			}
		},false);
		document.addEventListener('touchend', function(e) {
			if(multitouch) {
				mainstyle=window.getComputedStyle(maincontent);
				fontsize=parseInt(mainstyle.getPropertyValue("font-size"));
				setCookie("fontsize",fontsize,28);
				multitouch=false;
			}
		},false);



	}
}
