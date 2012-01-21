<!-- File: /app/View/users/set_address.ctp -->

<h1>ちょこくれ</h1>
<?php
echo $this->Form->create('User');
?>
チョコを受け取る、アナタの名前と住所を教えて下さい<br />
(この情報は公開されません)
<?
echo $this->Form->input('user_name',array('label'=>'名前：'));
echo $this->Form->input('postal_code',array('label'=>'郵便番号：'));
echo $this->Form->input('state',array('label'=>'都道府県：'));
echo $this->Form->input('city',array('label'=>'市区町村：'));
echo $this->Form->input('address_number',array('label'=>'番地：'));
echo $this->Form->input('apartment_name',array('label'=>'マンション名：'));
echo $this->Form->end('Save Post');
?>
</div>