// アラートメッセージの自動消去
$(function(){
	if(document.getElementById("flashWrapper")){
		var fadeY = 0 - $("#flashWrapper").height();
		$("#flashWrapper").css("top", fadeY + "px");
		$("#flashWrapper").animate({"top":"0px"}, "fast");

		if($.timer){
			$.timer(2000, function (timer) {
				$("#flashWrapper").animate({"top":fadeY + "px"}, "fast");
				timer.stop();
			});
		}else{
			setTimeout(function(){
				$("#flashWrapper").animate({"top":fadeY + "px"}, "fast");
			}, 2000);
		}
	}
})

