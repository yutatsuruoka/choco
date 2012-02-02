//#contentsFlow02 フォームplaceholder.js適用
$(function(){
    if(!Modernizr.input.placeholder){

        $('[placeholder]').focus(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
                input.removeClass('placeholder');
            }
        }).blur(function() {
            var input = $(this);
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.addClass('placeholder');
                input.val(input.attr('placeholder'));
            }
        }).blur();
        $('[placeholder]').parents('form').submit(function() {
            $(this).find('[placeholder]').each(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            })
        }); 
    }

});


//#contentsFlow03　#contentsFlow06 #contentsFlow09　マウスオーバー
$(".socialIntroduction img").hover(
        function(){ $(this).css("opacity", .6); },
        function(){ $(this).css("opacity", 1); }
);

//#contentsFlow04　マウスオーバー
$(".presentchoco .type03").hover(
        function(){ $(this).css("opacity", .6); },
        function(){ $(this).css("opacity", 1); }
);
//#contentsFlow07　マウスオーバー
$(".paypalLink").hover(
        function(){ $(this).css("opacity", .6); },
        function(){ $(this).css("opacity", 1); }
);


//colorbox 規約部分
$(function(){
    $(".inline").colorbox({inline:true, width:"60%", height:"70%"});
    $(".callbacks").colorbox({
        onOpen:function(){ alert('onOpen: colorbox is about to open'); },
        onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
        onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
        onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
        onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
    });

    //Example of preserving a JavaScript event for inline calls.
    $("#click").click(function(){ 
        $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
        return false;
    });
});

