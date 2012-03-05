    <div class="contents wrapper" id="flow03">

        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://chocokure.com/" data-text="【チョコくれ】ソーシャルバレンタインプラットフォーム-“次は女性たちの復讐が待ってるぞ”" data-hashtags="chocokure">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton right">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fchocokure.com%2F&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=312737992072908" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:24px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->
		<article>
       	<div class="caption">
            <p>選んだ商品は合っていますか？<br>
            次におねだり（復讐）する相手を選んで、
          	おねだりの準備を完了しましょう！</p>
        </div>
        <div class="presentInfo">
            <img class="presentImg" src="<?php echo $this->webroot ?>i_sp/present_a.jpg" width="300" height="200" alt="Pruduct name">
        </div>
		<?php echo $this->Form->create('User'); ?>
        <div class="formList">
            <ul>
            	<li>
        		<input type="text" placeholder="@ ここに相手のTwitterアカウント名を入力" id="twname" name="twname">
        		</li>
       		<div class="caption">
            	<p>商品はneda.lyが郵送であなたにお届けします。<br>
            	あなたの住所、もしくは希望の郵送先を入力して下さい♩
            	送信ボタンを押せばおねだりが完了します♩</p>
        	</div>
                <li>
                <label for="">宛名</label>
                <input type="text" placeholder="おねだり太郎" id="user_name" name="user_name" value= <?php echo $user['User']['user_name'] ?>>
                </li>
                <li>
                <label for="">郵便番号</label>
                <input type="text" placeholder="150-0002" id="postal_code" name="postal_code" value= <?php echo $user['User']['postal_code'] ?>>
                </li>
                <li>
                <label for="">住所</label>
                <input type="text"  placeholder="東京都渋谷区渋谷1-1" id="address" name="address" value= <?php echo $user['User']['address'] ?>>
                </li>
                <li>
                <label for="">電話番号</label>
                <input type="text"  placeholder="03-0000-0000" id="tel" name="tel" value=<?php echo $user['User']['tel'] ?>>
                </li>
                <li>
                <label for="">メールアドレス</label>
                <input type="text" placeholder="gimmechoco@gmail.com" id="mail" name="mail" value=<?php echo $user['User']['mail'] ?>>
                </li>
            </ul>
        </div>
        
        <div class="menu">
            <ul>
                <li><input id="twSubmitBtn" value="おねだり送信" type="submit"></li>
            </ul>
        </div>
        <?php echo $this->Form->end(); ?>
        </article>
    </div>
