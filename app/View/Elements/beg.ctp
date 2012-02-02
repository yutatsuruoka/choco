<?php

// setup javascripts
$this->Html->script('twitter_input', array('inline' => false));

echo $this->Form->create('Post');
?>	 

<div class="entryContainer">
    <div class="wrapper">
        <p class="counter">The remainder of<strong>2,000</strong>chocolates<p>     
        <div class="clearfix">
            <div class="left parenthesis"><img src="<?php echo $this->webroot ?>i/parenthesis_left.png" alt=""></div>
            <div class="left formContainer">
                <form class="clearfix" action="">
                    <?
                        echo $this->Form->input('girl_id',array(
                            'id' => 'twitterAccount'
                            , 'placeholder' => "女の子のTwitterアカウントを入力"
                            , 'type' => 'text'
                            , 'label' => false
                            ));
                    	echo $this->Form->submit('',array('id' => 'submitButton'));
                    ?>
                </form>
                <p>チョコをもらいたい女の子のTwitterアカウントを入れて ”チョコくれ！” ボタンをクリック♩ Twitter認証へ飛んでいきます！</p>
            </div>
            <div class="right parenthesis"><img src="<?php echo $this->webroot ?>i/parenthesis_right.png" alt=""></div>
        </div>
    </div>
</div><!-- end .entryContainer -->

<?php
echo $this->Form->end();
?>