<!-- File: /app/View/Posts/add.ctp -->

<h1>ちょこくれ</h1>
<?php
echo $this->Form->create('Post');
?>
誰にチョコをネダリますか？<br>
<?
echo $this->Form->input('title',array('label'=>"twitterアカウント"));
?>
チョコを受け取る名前と住所を教えて下さい<br>
(この情報は公開されません)
<?
echo $this->Form->input('title',array('label'=>'名前：'));
echo $this->Form->input('title',array('label'=>'郵便番号：'));
echo $this->Form->input('title',array('label'=>'都道府県：'));
echo $this->Form->input('title',array('label'=>'市区町村：'));
echo $this->Form->input('title',array('label'=>'番地：'));
echo $this->Form->input('title',array('label'=>'マンション名：'));
echo $this->Form->end('Save Post');
?>
</div>