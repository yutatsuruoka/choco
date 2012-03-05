 <!-- File: /app/View/Posts/set_type.ctp -->

<?php
    $this->set('html_body_id', 'contentsFlow04');
?>

    <!-- ===== boy_top ================================================================================================================================== -->
    <div class="boy wrapper" id="boy_top">
        <div class="onedariGirlContainer clearfix">
            <div class="imgContainer left">
                <img src="<?php echo $avatar; ?>" alt="" height = "100px" width = "100px" >
            </div>
            <div class="commentContainrt">
                <p class="comment">私はあなたからプレゼントをもらいたいと思っています。<br>
                他の人じゃダメなの。あなたじゃないと。<br>
                だって私、あなたの事が大好きなんだもん…</p>
            </div>
        </div>
        <div class="onedariCaption">
            <p><span class="pink">@<?php echo $girl_id ?> さん</span>が気になる男性として<br>
            あなたにプレゼントのおねだりをしています。<br>
            ホワイトデーに向けてプレゼントを送ってみませんか？</p>
            <p class="info">チョコくれ！とは、女性が気になる男性にホワイトデーのプレゼントをおねだり出来る<br>
            ソーシャルホワイトデープラットフォームです。</p>

        </div>
        <div class="present">
            <img src="<?php echo $this->webroot ?>i/present_a.jpg" alt="Pruduct name">
            <h2>Pruduct name</h2>
            <p class="price">¥500<span>プレゼントして当たり前だよねってレベル</span></p>
        </div>
        <div class="choiceBtn">
            <ul class="clearfix">
                <li><a href="<?php echo $this->webroot ?>Payment/index/<?php echo $post_id ?>"><img src="<?php echo $this->webroot ?>i/presentbtn01.png" alt="プレゼントする"></a></li>
                <li class="last"><a href="<?php echo $this->webroot ?>Posts/no/<?php echo $post_id ?>"><img src="<?php echo $this->webroot ?>i/presentbtn02.png" alt="僕はあげたくない"></a></li>
            </ul>
        </div>

    </div>

