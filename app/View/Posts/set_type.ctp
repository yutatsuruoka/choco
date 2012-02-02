<!-- File: /app/View/Posts/set_type.ctp -->

<?php
    $this->set('html_body_id', 'contentsFlow04');
?>

        <div class="presentchoco">
            <div class="wrapper">
                <div class="presentContainer">
                    <div class="pushMessage clearfix">
                        <div class="twitterImage left">
                            <img class="twitterIcon" src="https://api.twitter.com/1/users/profile_image?screen_name=<?php echo $screen_name ?>&size=bigger" alt="">
                            <p class="twitterName">@<?php echo $screen_name ?></p>
                        </div>
                        <div class="messageContainer left">
                            <p class="message">２０文字以内のテキストがはいります。</p>
                        </div>
                    </div>
                    <div class="btnContainer clearfix">
                        <ul class="clearfix">
                            <li class="left"><a class="type01 over" href="">本命チョコをあげる</a></li>
                            <li class="left"><a class="type02 over" href="">義理チョコをあげる</a></li>
                            <li class="left"><a class="type03 last " href="<?php echo $this->webroot ?>Pages/no"><img src="<?php echo $this->webroot ?>i/presentchoco_btn02.png" alt=""></a></li>
                        </ul>                       
                    </div>
                </div>
                <p class="counter">残り<strong>2,000</strong>チョコ<p>     
                <p class="caption">チョコは１個￥５００で購入出来ます。あなたが送ったチョコは、バレンタインの日に彼の元へ直接送られます。</p>
            </div>
        </div>

