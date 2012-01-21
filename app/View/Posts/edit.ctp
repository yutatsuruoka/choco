<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Post</h1>
<?php
    echo $this->Form->create('Post', array('action' => 'edit'));
    echo $this->Form->input('title');
    echo $this->Form->input('u_name');
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('feeling');
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');