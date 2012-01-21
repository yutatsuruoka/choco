<!-- File: /app/View/Posts/set_type.ctp -->

<?php
echo $this->Form->create('Post');
?>
<?php
echo $this->Form->radio('type', array('1'=>"本命", '2'=>"義理"), 
        array('legend' => 'この人は本名ですか？', 'value' => '2', 'separator' => '　'));

echo $this->Form->end('Save Post');
?>
</div>