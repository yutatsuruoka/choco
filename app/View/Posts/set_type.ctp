<!-- File: /app/View/Posts/set_type.ctp -->

<?php
    $this->set('html_body_id', 'contentsFlow04');
?>

        <div class="presentchoco">
            <div class="wrapper">
                <div class="presentContainer">
                    <p class="twitterName">@<?php echo $screen_name ?> さんが @<?php echo $girl_id ?> さんにチョコをねだっています</p>
                    <div class="pushMessage clearfix">
                        <div class="twitterImage left">
                            <img class="twitterIcon" src="https://api.twitter.com/1/users/profile_image?screen_name=<?php echo $screen_name ?>&size=bigger" alt="">
                        </div>
                        <div class="messageContainer left">
                            <p class="message">チョコください!!<br>お願いします。</p>
                        </div>
                    </div>
                    <div class="btnContainer clearfix">
                        <ul class="clearfix">
                            <li class="left"><a class="type01 over" href="<?php echo $this->webroot ?>Users/give/<?php echo $post_id ?>/1">本命チョコをあげる</a></li>
                            <li class="left"><a class="type02 over" href="<?php echo $this->webroot ?>Users/give/<?php echo $post_id ?>/2">義理チョコをあげる</a></li>
                            <li class="left"><a class="type03 last " href="<?php echo $this->webroot ?>Pages/no"><img src="<?php echo $this->webroot ?>i/presentchoco_btn02.png" alt=""></a></li>
                        </ul>                       
                    </div>
                </div>
                <p class="caption">チョコは1つ500円で購入出来ます。チョコをあげるボタンをクリックするとtwitterの認証画面へ飛び、<br>
クレジット決済手続きが開始されます。あとは相手にチョコが届くのを待つだけ！</p>
            </div>
        </div>

