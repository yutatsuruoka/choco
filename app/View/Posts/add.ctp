<!-- File: /app/View/Posts/add.ctp -->

<h1>ちょこくれ</h1>
<?php
echo $this->Form->create('Post');
?>
誰にチョコをネダリますか？<br />
<?
echo $this->Form->input('girl_id',array('label'=>"相手のtwitterアカウント　@", 'id' => true, 'type' => 'text'));
echo $this->Form->end('Save Post');
?>
</div>