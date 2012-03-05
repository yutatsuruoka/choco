<?php
    $this->set('html_body_id', 'contentsFlow10');
?>

    <div class="boy wrapper" id="boy_ok1">
        <div class="onedariGirlContainer clearfix">
            <div class="imgContainer left">
                <img src="<?php echo $avatar; ?>" alt="">
            </div>
            <div class="commentContainrt">
                <p class="comment">私はあなたからプレゼントをもらいたいと思っています。<br>
                他の人じゃダメなの。あなたじゃないと。<br>
                だって私、あなたの事が大好きなんだもん…</p>
            </div>
        </div>
        <div class="onedariCaption">
            <p>OK!<br>
                あなたは<span class="pink">とても優しい人</span>です。<br>
                相手も必ず喜んでくれるでしょう。<br>
                下記のどちらかを選択して<span class="pink">2人の共同作業を完了</span>させて下さい♩</p>
        </div>
        <div class="choiceBtn">
            <ul class="clearfix">
                <li><a href="<?php echo $this->webroot ?>Payment/paypal/<?php echo $post_id ?>"><img src="<?php echo $this->webroot ?>i/presentbtn03.png" alt="PayPalでプレゼント"></a></li>
                <li class="last"><a href="<?php echo $this->webroot ?>Payment/bank"><img src="<?php echo $this->webroot ?>i/presentbtn04.png" alt="楽天からプレゼント"></a></li>
            </ul>
        </div>

    </div>