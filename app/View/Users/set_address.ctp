<?php
echo $this->Form->create('Post');
?>	 
<div id="formSheet">
            <div class="wrapper">
                <h2><img src="/cake/app/webroot/i/formsheet_ttl.png" alt=""></h2>
                <p class="caption">チョコを届けて欲しい住所を入力して下さい。<br>バレンタインの日、指定された場所にチョコが届きます♩</p>
                <form class="clearfix">
                    <div class="sheetContainer left">
                        <ul>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="name">お名前</label></div>
                            <div class="inputContainer"><? echo $this->Form->input('user_name',array("label" => false, 'type' => 'text', "placeholder" => "家入 一真", "id" => "name", 'value'=>$user['User']['user_name'])); ?></div>
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="tel">郵便番号</label></div>
                            <div class="inputContainer"><? echo $this->Form->input('postal_code',array("label" => false, 'type' => 'text', "placeholder" => "150-0002", "id" => "zip", 'value'=>$user['User']['postal_code'])); ?></div>
                            </li>
                            <li class="clearfix fixHeight last">
                            <div class="labelContainer"><label for="mail">住所</label></div>
                            <div class="inputContainer"><? echo $this->Form->input('address',array("label" => false, 'type' => 'text', "placeholder" => "東京都渋谷区渋谷1-17-1", "id" => "address", 'value'=>$user['User']['address'])); ?></div>
                            </li>
                        </ul>
                    </div> 
                    <div class="sheetContainer right">
                        <ul>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="tel">電話番号</label></div>
                            <div class="inputContainer"><? echo $this->Form->input('tel',array("label" => false, 'type' => 'text', "placeholder" => "03-0000-0000", "id" => "tel", 'value'=>$user['User']['tel'])); ?></div>
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="mail">メール(仮)</label></div>
                            <div class="inputContainer"><? echo $this->Form->input('mail',array("label" => false, 'type' => 'text', "placeholder" => "03-0000-0000", "id" => "mail", 'value'=>$user['User']['tel'])); ?></div>
                            <!-- <input type="text" placeholder="gimmechoco@gmail.com" id="mail" name="mail"></div> -->
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="mail">メッセージ(仮)</label></div>
                            <div class="inputContainer"><? /*echo $this->Form->input('',array("label" => false, 'type' => 'text', "placeholder" => "メッセージはモデルが違う", "id" => "mail", 'value'=>$user['User']['']));*/ ?></div>
                            <!-- <input type="text" placeholder="20文字以内" id="mail" name="mail"></div> -->
                            </li>
                        </ul>
                    </div>
                    <p class="submit"><? echo $this->Form->submit('',array('id' => 'sheetBtn')); ?>
                    <!-- <input type="submit" id="sheetBtn" src="i/submit_btn.png" value=""></p> -->
                </form>
            </div>
        </div>
        
<?
/*
echo $this->Form->input('user_name',array('label'=>'名前：', 'value'=>$user['User']['user_name']));
echo $this->Form->input('postal_code',array('label'=>'郵便番号：', 'value'=>$user['User']['postal_code']));
echo $this->Form->input('address',array('label'=>'都道府県：', 'value'=>$user['User']['address']));
echo $this->Form->input('city',array('label'=>'市区町村：', 'value'=>$user['User']['city']));
echo $this->Form->input('address_number',array('label'=>'番地：', 'value'=>$user['User']['address_number']));
echo $this->Form->input('apartment_name',array('label'=>'マンション名：', 'value'=>$user['User']['apartment_name']));
echo $this->Form->end('Save Post');
*/
?>
<?
echo $this->Form->end();
?>
