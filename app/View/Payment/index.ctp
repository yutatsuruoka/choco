<?php
    $this->set('html_body_id', 'contentsFlow10');
?>

    <div class="boy wrapper" id="boy_ok1">
        <div class="onedariGirlContainer clearfix">
            <div class="imgContainer left">
                <img src="<?php echo $avatar; ?>" alt="" height = "100px" width = "100px" >
            </div>
            <div class="commentContainrt">
                <p class="comment" style="margin-top:5px;">あと一歩だよ。<br>
                あなたのプレゼント、絶対大事にするね。</p>
            </div>
        </div>
        <div class="onedariCaption">
            <p>OK!<br>
                あなたは<span class="pink">とても優しい人</span>です。<br>
                おねだり商品は５分で簡単に決済出来ます。</p>
        </div>
        <div class="choiceBtn">
            <ul class="clearfix">
                <li><a href="<?php echo $this->webroot ?>Payment/paypal/<?php echo $post_id ?>"><img src="<?php echo $this->webroot ?>i/presentbtn03.png" alt="PayPalでプレゼント"></a></li>
            </ul>
        </div>
                <div id="info_text_paypal">
            <p>
            <span class="info_title"><a href="https://www.paypal.com/jp/cgi-bin/webscr?cmd=_home" target="_blank">PayPal</a>ってなあに？</span><br>
            PayPalは世界で最も利用者の多いネット決済サービスです。
            アカウントを登録しておくと、今後も様々なサイトで簡単に
            利用する事が出来ます♩
            <br><br>
            ※neda.lyは決済を含むサービスです。
            より安心してご利用頂く為、下記の<a class="ajax" href="popup01.html">特定商取引に基づく表記</a>などをご参考のうえご利用下さい。
            </p>
        </div>


    </div>
