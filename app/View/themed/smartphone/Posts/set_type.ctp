<?php
    $this->set('html_body_id', 'contentsFlow06');
?> 
    <div class="contents wrapper" id="flow06">
        <div class="captionContainer  center">
            <p class="cap"> チョコくれ！が女性の為に帰ってきたぜ！！<br>
            ホワイトデーを使って男性におねだり（復讐）できる、<br>
            ソーシャルおねだりプラットフォーム。
            </p>
            <p class="news"><a href="">16:32 Yahoo!ニュースのトップページに掲載されました &gt;&gt;</a></p>
        </div><!-- end wrapper captionContainer-->

        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://neda.ly/" data-text="【neda.ly】ソーシャルおねだりプラットフォームの解禁。二人なら、ビスケットは半分こでも笑顔は二倍だよね！" data-hashtags="nedaly">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton right">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fnedaly.warusou&amp;send=false&amp;layout=button_count&amp;width=125&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=149485031807635" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:24px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->

        <article>

        <section class="caption">
        <h3><img src="<?php echo $this->webroot ?>i_sp/boy_top_cap.png" alt="welcome to nice guy!! " width="185" height="28"></h3>
        <p><a href="">@<?php echo $girl_id ?></a> さんが気になる男性として
        あなたにプレゼントのおねだりをしています。
        ホワイトデーに向けてプレゼントを送ってみませんか？</p>
        </section>

        <section class="present">
        <div class="presentTtl">
            <div>
                <h2><?php echo $product['Product']['name'] ?> / ¥<?php echo $product['Product']['price'] ?></h2>
                <p>これはプレゼントして当たり前だよねってレベル</p>
            </div>
        </div>
        <img src="<?php echo $this->webroot ?>i/present_<?php echo $product['Product']['id'] ?>.jpg" width="300" height="200" alt="Pruduct name">
        <ul class="onedariBtn clearfix">
            <li class="left tw"><a href="<?php echo $this->webroot ?>Posts/no/<?php echo $post_id ?>">▶ 僕はケチだから断る</a></li>
            <li class="right fb"><a href="<?php echo $this->webroot ?>Payment/index/<?php echo $post_id ?>">▶ もちろんプレゼント</a></li>
        </ul>
        </section>
        </article>
        
    </div>
