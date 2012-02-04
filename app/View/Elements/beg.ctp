<?php
    $e  = '';
    if ($errors) {
        foreach($errors as $error) {
            if (strlen($e) > 0) {
                $e .= '<br>';
            }
            $e .= $error[0];
        }
    }
    if (strlen($e) == 0) {
        $e = '限定<strong>' . $remaining . '</strong>チョコ';
    }
?>
        <div class="entryContainer">
    <div class="wrapper">
        <p class="counter"><?php echo $e ?></p>     
        <div class="clearfix">
            <div class="left parenthesis"><img src="<?php echo $this->webroot ?>i/parenthesis_left.png" alt=""></div>
            <div class="left formContainer">
                <?
                    echo $this->Form->create('Post', array('class'=>'clearfix'));
                    echo $this->Form->input('girl_id',array(
                        'id' => 'twitterAccount'
//                        , 'placeholder' => "女の子のTwitterアカウントを入力"
                        , 'type' => 'text'
                        , 'label' => false
                        , 'class' => 'jq-placeholder'
                        , 'title' => "女の子のTwitterアカウントを入力"
                        , 'error' => false
                        ));
                    echo $this->Form->submit('',array('id' => 'submitButton'));
                    echo $this->Form->end();
                ?>
                <p>チョコをねだりたい女の子のTwitterアカウントを入れて ”チョコくれ！” ボタンをクリック！ Twitter認証へ飛んでいきます！</p>
            </div>
            <div class="right parenthesis"><img src="<?php echo $this->webroot ?>i/parenthesis_right.png" alt=""></div>
        </div>
    </div>
</div><!-- end .entryContainer -->
