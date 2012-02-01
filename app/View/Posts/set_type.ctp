<!-- File: /app/View/Posts/set_type.ctp -->

<?php
echo $this->Form->create('Post');
?>

<div class="presentchoco">
        <img class="arrow" src="/cake/app/webroot/i/about_topbg.png" alt="">
        <div class="wrapper">
            <div class="presentContainer">
                <div class="pushMessage clearfix">
                    <div class="twitterImage left">
                        <img class="twitterIcon" src="/cake/app/webroot/i/twitter_icon.jpg" alt="">
                        <p class="twitterName">@hbkr</p>
                    </div>
                    <div class="messageContainer left">
                        <p class="message">２０文字以内のテキストがはいります。</p>
                    </div>
                </div>
                <div class="btnContainer clearfix">
                    <ul class="clearfix">
                        <li class="left"><a class="type01 over" href="">本命チョコをあげる</a></li>
                        <li class="left"><a class="type02 over" href="">義理チョコをあげる</a></li>
                        <li class="left"><a class="type03 last " href=""><img src="/cake/app/webroot/i/presentchoco_btn02.png" alt=""></a></li>
                    </ul>                       
                </div>
            </div>
            <h2><img src="/cake/app/webroot/i/entry_caption.png" alt=""></h2>
            <p class="caption">チョコは１個￥５００で購入出来ます。あなたが送ったチョコは、バレンタインの日に彼の元へ直接送られます。</p>
        </div>
</div>

<?php
echo $this->Form->radio('type', array('1'=>"本命", '2'=>"義理"), 
        array('legend' => 'この人は本名ですか？', 'value' => '2', 'separator' => '　'));

echo $this->Form->end('Save Post');
?>