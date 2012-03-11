<?php
    $this->set('html_body_id', 'contentsFlow01');
?>
    <div class="contents wrapper" id="top">
        <div class="captionContainer  center">
            <p class="cap"> チョコくれ！が女性の為に帰ってきたぜ！！<br>
            ねだり返せ！ホワイトデーを300%から楽しむ、<br>
            ソーシャルおねだりプラットフォーム。
            </p>
            <p class="news"><a href=""></a></p>
        </div><!-- end wrapper captionContainer-->

        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://neda.ly/" data-text="【neda.ly】ソーシャルおねだりプラットフォームの解禁。二人なら、ビスケットは半分こでも笑顔は二倍だよね！" data-hashtags="nedaly">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton right">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fneda.ly%2F&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=312737992072908" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:24px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->
        <article>
        <section class="present">
        <div class="presentTtl clearfix">
            <div class="left num">1</div>
            <div class="left">
                <h2><?php echo $product[0]["Product"]['name'] ?> / ¥<?php echo $product[0]["Product"]['price'] ?></h2>
                <p>バスグッズ等のセットとなります。</p>
            </div>
        </div>
        <img src="<?php echo $this->webroot ?>i/present_4.jpg" width="300" height="200" alt="Pruduct name">
        <ul class="onedariBtn clearfix">
            <li class="left tw"><a href="<?php echo $this->webroot ?>Posts/add/4">▶ Twitterでおねだり</a></li>
            <li class="right fb"><a href="<?php echo $this->webroot ?>Posts/addfb/4">▶ Facebookでおねだり</a></li>
        </ul>
        </section>
        <section class="present">
        <div class="presentTtl clearfix">
            <div class="left num">2</div>
            <div class="left">
                <h2>Coming Soon!!</h2>
                <p></p>
            </div>
        </div>
        <img src="<?php echo $this->webroot ?>i/present_50.jpg" width="300" height="200" alt="Pruduct name">
        <ul class="onedariBtn clearfix">
            <li class="left tw" style="background: #999999"><a href="/">▶ Twitterでおねだり</a></li>
            <li class="right fb" style="background: #999999"><a href="/5">▶ Facebookでおねだり</a></li>
        </ul>
        </section>
        <section class="present">
        <div class="presentTtl clearfix">
            <div class="left num">3</div>
            <div class="left">
                <h2>Coming Soon!!</h2>
                <p></p>
            </div>
        </div>
        <img src="<?php echo $this->webroot ?>i/present_60.jpg" width="300" height="200" alt="Pruduct name">
        <ul class="onedariBtn clearfix">
            <li class="left tw" style="background: #999999"><a href="/">▶ Twitterでおねだり</a></li>
            <li class="right fb" style="background: #999999"><a href="/">▶ Facebookでおねだり</a></li>
        </ul>
        </section>
        </article>
        
    </div>
    
    
