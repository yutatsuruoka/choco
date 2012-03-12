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
    <div class="contents wrapper" id="flow02_fb">

        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://neda.ly/" data-text="【neda.ly】ソーシャルおねだりプラットフォームの解禁。二人なら、ビスケットは半分こでも笑顔は二倍だよね！" data-hashtags="nedaly">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton right">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fnedaly.warusou&amp;send=false&amp;layout=button_count&amp;width=125&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=149485031807635" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:24px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->
        <div class="presentInfo">
            <p class="presentText">選んだ商品は合っていますか？<br>
            次におねだり（復讐）する相手を選んで、<br>
            おねだりの準備を完了させよう！</p>
            <img class="presentImg" src="<?php echo $this->webroot ?>i/present_<?php echo $post["Post"]['type'] ?>.jpg" width="300" height="200" alt="Pruduct name">
        </div>
		<?php echo $this->Form->create('User'); ?>
        <div class="fbList" >
            <form>
                <select id="fbname" name="fbname" style="">
                	<?php foreach($friendIds['data'] as $fid ){ ?>
        				<option value="<?php echo $fid['name']; ?>"><?php echo $fid['name']; ?></option>
        			<?php } ?>
                </select>
        </div>
        
        <div class="formList">
       		<div class="caption">
            	<p>商品は郵送されるよ。<br>
            	郵送先の住所を建物名や部屋番号まで記入してね。<br>
            	[おねだり送信]商品ボタンを押せばおねだり完了♩</p>
            </div>
            <ul>
                <li>
                <label for="">宛名</label>
                <input type="text" placeholder="例：キャリーぱみゅぱみゅ" id="user_name" name="user_name" value= <?php echo $user['User']['user_name'] ?>>
                </li>
                <li>
                <label for="">郵便番号</label>
                <input type="text" placeholder="例：150-0002" id="postal_code" name="postal_code" value= <?php echo $user['User']['postal_code'] ?>>
                </li>
                <li>
                <label for="">住所</label>
                <input type="text" style="font-size:9px;"  placeholder="例：東京都渋谷区渋谷1-1 ※建物名、部屋番号を忘れずに！" id="address" name="address" value= <?php echo $user['User']['address'] ?>>
                </li>
                <li>
                <label for="">電話番号</label>
                <input type="text"  placeholder="例：03-0000-0000" id="tel" name="tel" value=<?php echo $user['User']['tel'] ?>>
                </li>
                <li>
                <label for="">メールアドレス</label>
                <input type="text" placeholder="例：gimmechoco@gmail.com" id="mail" name="mail" value=<?php echo $user['User']['mail'] ?>>
                </li>
            </ul>
            <div class="submitBtn">
                <ul>
                    <li><input id="SubmitBtn" value="おねだり送信" type="submit"></li>
                </ul>
            </div>
        </div>
        
        </form>
        <?php echo $this->Form->end(); ?>
        </article>
    </div>
