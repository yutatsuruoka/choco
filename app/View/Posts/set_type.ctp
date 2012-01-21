<!-- File: /app/View/Posts/set_type.ctp -->

<h1>本命？</h1>
<?php
echo $this->Form->create('Post');
?>
この人は本名ですか？<br />
<?php
echo $this->Form->input('girl_id',array('label'=>"相手のtwitterアカウント　@", 'id' => true, 'type' => 'text'));
echo $this->Form->end('Save Post');
?>
</div>