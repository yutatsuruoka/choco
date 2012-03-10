<?php
    $this->set('html_body_id', 'contentsFlow06');
?>

    <!-- ===== boy_kyohi ================================================================================================================================== -->
    <div class="boy wrapper" id="boy_kyohi1">
        <div class="onedariGirlContainer clearfix">
            <div class="imgContainer left">
                <img src="<?php echo $avatar; ?>" alt="" height = "100px" width = "100px">
            </div>
            <div class="commentContainrt">
                <p class="comment" style="margin-top:7px">勇気を出しておねだりしてみたけど、<br>
                やっぱりダメ...かな？</p>
            </div>
        </div>
        <div class="onedariCaption">
            <p>このままではあなたの株が下がってしまいます。<br>
            本当にプレゼントはしませんか？</p>

        </div>
        <div class="present">
            <img src="<?php echo $this->webroot ?>i/present_<?php echo $product['Product']['id'] ?>.jpg" alt="Pruduct name">
            <h2><?php echo $product['Product']['name'] ?></h2>
            <p class="price">¥<?php echo $product['Product']['price'] ?><!-- <span>プレゼントして当たり前だよねってレベル</span> --></p>
        </div>
        <div class="choiceBtn">
            <ul class="clearfix">
                <li><a href="<?php echo $this->webroot ?>Payment/index/<?php echo $post_id ?>"><img src="<?php echo $this->webroot ?>i/presentbtn01.png" alt="プレゼントする"></a></li>
                <li class="last"><a href="<?php echo $this->webroot ?>Posts/nono/"><img src="<?php echo $this->webroot ?>i/presentbtn05.png" alt="絶対あげたくない"></a></li>
            </ul>
        </div>

    </div>
