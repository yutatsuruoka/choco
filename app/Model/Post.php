<?php
class Post extends AppModel {
    public $name = 'Post';

    public $validate = array(
        'girl_id' => array(
            'rule' => 'notEmpty',
            'rule' => array('custom', '/[a-z0-9_@]$/i'),
        ),
    );
}