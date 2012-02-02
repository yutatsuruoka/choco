<?php
    $this->set('html_body_id', 'contentsFlow02');
    echo $this->Session->flash();
?>	 
        <div id="formSheet">
            <div class="wrapper">
                <h2><img src="<?php echo $this->webroot ?>i/formsheet_ttl.png" alt=""></h2>
                <p class="caption">チョコを届けて欲しい住所を入力して下さい。<br>バレンタインの日、指定された場所にチョコが届きます♩</p>
                    <?php echo $this->Form->create('User', array('class'=>'clearfix')); ?>	 
                    <div class="sheetContainer left">
                        <ul>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="name">お名前</label></div>
                            <div class="inputContainer"><input type="text" placeholder="家入 一真" id="name" name="name"></div>
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="tel">郵便番号</label></div>
                            <div class="inputContainer"><input type="text" placeholder="150-0002" id="postal_code" name="postal_code"></div>
                            </li>
                            <li class="clearfix fixHeight last">
                            <div class="labelContainer"><label for="mail">住所</label></div>
                            <div class="inputContainer"><input type="text"  placeholder="東京都渋谷区渋谷1-17-1" id="address" name="address"></div>
                            </li>
                        </ul>
                    </div> 
                    <div class="sheetContainer right">
                        <ul>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="tel">電話番号</label></div>
                            <div class="inputContainer"><input type="text"  placeholder="03-0000-0000" id="tel" name="tel"></div>
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="mail">メール</label></div>
                            <div class="inputContainer"><input type="text" placeholder="gimmechoco@gmail.com" id="email" name="enail"></div>
                            </li>
                            <li class="clearfix fixHeight">
                            <div class="labelContainer"><label for="mail">メッセージ</label></div>
                            <div class="inputContainer"><input type="text" placeholder="20文字以内" id="mail" name="mail"></div>
                            </li>
                        </ul>
                    </div>
                    <p class="submit"><input type="submit" id="sheetBtn" src="<?php echo $this->webroot ?>i/submit_btn.png" value=""></p>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
