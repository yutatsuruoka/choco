<?php
    $this->set('html_body_id', 'contentsFlow02');

    $e  = '';
    if ($errors) {
        foreach($errors as $error) {
            if (strlen($e) > 0) {
                $e .= '<br>';
            }
            $e .= $error[0];
        }
    }

    if (strlen($e) == 0) {
        $e = $this->Session->flash();
    }
    
    echo '<font color=\'red\'>' . $e . '</font>';
?>	 

<!-- ===== girl_2nd_tw ================================================================================================================================== -->
    <div class="girl_2nd wrapper" id="girl_2nd_tw">
        <div class="captionContainer mgb50">
            <p><img src="<?php echo $this->webroot ?>i/girl_2nd_fb_caption.png" alt="認証が無事に終わりました！あなたの送り先の住所を入力して、おねだりをする相手を選んで下さい。"></p>
        </div><!-- end wrapper captionContainer-->
        <article>
            <?php echo $this->Form->create('User', array('class'=>'formContainer clearfix')); ?>	 
            <div class="formContainer clearfix">
                <div class="left">
                    <div class="presentImg">
                        <img src="<?php echo $this->webroot ?>i/girl_2nd_present.jpg" alt="">
                    </div><!-- end left presentImg -->
                    <div class="twAccountForm">
                        <ul class="sheetContainer">
                            <li>
                            <div class="inputContainer"><input type="text" placeholder="@おねだりする相手のアカウント名を入力" class="jq-placeholder" id="twname" name="twname"></div>
                            </li>
                        </ul>
                        <p class="txt">送信ボタンを押すと相手にメンションで通知されます</p>
                    </div>
                </div>
                <div class="right">
                    <ul class="sheetContainer">
                        <li class="clearfix">
                        <div class="labelContainer"><label for="name">お名前</label></div>
                        <div class="inputContainer"><input type="text" title="例：キャリーぱみゅぱみゅ" class="jq-placeholder" id="user_name" name="user_name" value= <?php echo $user['User']['user_name'] ?>></div>
                        </li>
                        <li class="clearfix">
                        <div class="labelContainer"><label for="tel">郵便番号</label></div>
                        <div class="inputContainer"><input type="text" title="例：150-0002" class="jq-placeholder" id="postal_code" name="postal_code" value= <?php echo $user['User']['postal_code'] ?>></div>
                        <li class="clearfix">
                        <div class="labelContainer"><label for="mail">住所</label></div>
                        <div class="inputContainer"><input type="text" style="font-size:10px;" title="例：東京都渋谷区渋谷1-1 ※建物名、部屋番号を忘れずに！" class="jq-placeholder" id="address" name="address" value= <?php echo $user['User']['address'] ?>></div>
                        </li>
                        <li class="clearfix">
                        <div class="labelContainer"><label for="tel">電話番号</label></div>
                        <div class="inputContainer"><input type="text"  title="例：03-0000-0000"  class="jq-placeholder" id="tel" name="tel" value=<?php echo $user['User']['tel'] ?>></div>
                        </li>
                        <li class="clearfix last">
                        <div class="labelContainer"><label for="mail">メール</label></div>
                        <div class="inputContainer"><input type="text" title="例：gimmechoco@gmail.com" class="jq-placeholder" id="mail" name="mail" value=<?php echo $user['User']['mail'] ?>></div>
                        </li>

                    </ul>
                </div><!-- end right -->
            </div><!-- end formContainer -->
            <div class="submit">
                <input id="twSubmitBtn" value="" type="submit">
                <?php echo $this->Form->end(); ?>
            </div>
        </article>
    </div>
