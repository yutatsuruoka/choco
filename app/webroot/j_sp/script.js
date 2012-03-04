//placeholder.js
$('.jq-placeholder').ahPlaceholder({
    placeholderColor : '#999',
    likeApple : true
});


//top Twitter Facebookおねだりボタンマウスオーバー
$(".onedariContainer img").hover(
        function(){ $(this).css("opacity", .8); },
        function(){ $(this).css("opacity", 1); }
);

//girs finish マウスオーバー
$("#girl_finish .returnTop img").hover(
        function(){ $(this).css("opacity", .8); },
        function(){ $(this).css("opacity", 1); }
);
//boy マウスオーバー
$(".choiceBtn img").hover(
        function(){ $(this).css("opacity", .6); },
        function(){ $(this).css("opacity", 1); }
);


//colorbox 規約部分
$(function(){
    $(".ajax").colorbox({width:"60%", height:"70%"});
    $(".callbacks").colorbox({
        onOpen:function(){ alert('onOpen: colorbox is about to open'); },
        onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
        onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
        onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
        onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    //Example of preserving a JavaScript event for inline calls.
    $("#click").click(function(){ 
        $('#click').css({"background-color":"#f00", "color":"#000", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
        return false;
    });
});



