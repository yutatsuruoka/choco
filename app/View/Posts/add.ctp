<?php
echo $this->Form->create('Post');
?>	 
<div class="entryContainer">
    <div class="wrapper">
        <p class="caption"><img src="/cake/app/webroot/i/entry_caption.png"></p>     
        <div class="clearfix">
            <div class="left parenthesis"><img src="i/parenthesis_left.png" alt=""></div>
            <div class="left formContainer">
                <form class="clearfix" action="">
                	<?
					echo $this->Form->input('girl_id',array('id' => 'twitterAccount', 'placeholder' => "女の子のTwitterアカウントを入力", 
					'type' => 'text', 'onfocus' => "value => '@'"));
                    ?>
                    <?
            		echo $this->Form->submit('',array('id' => 'submitButton'));
            		?>
                </form>
                <p>チョコをもらいたい女の子のTwitterアカウントを入れて ”チョコくれ！” ボタンをクリック♩ Twitter認証へ飛んでいきます！</p>
            </div>
            <div class="right parenthesis"><img src="i/parenthesis_right.png" alt=""></div>
        </div>
    </div>
</div><!-- end .entryContainer -->
<?
echo $this->Form->end();
?>
