<?php
class Post extends AppModel {
    public $name = 'Post';

    public $validate = array(
        'girl_id' => array(
            'rule' => 'notEmpty'
            , 'rule' => array('custom', '/[a-z0-9_@]$/i')
            , 'message' => '不適切な文字が入力されています' 
        ),

        'girl_avatar' => array(
            'rule' => 'notEmpty'
            , 'message' => 'Twitter IDに誤りがあります' 
        ),
    );
}