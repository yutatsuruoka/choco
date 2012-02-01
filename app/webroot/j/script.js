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
