    <div class="contents wrapper" id="flow03">

        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://neda.ly/" data-text="【neda.ly】ソーシャルおねだりプラットフォームの解禁。二人なら、ビスケットは半分こでも笑顔は二倍だよね！" data-hashtags="nedaly">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton right">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fnedaly.warusou&amp;send=false&amp;layout=button_count&amp;width=140&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=149485031807635" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:24px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->
		<article>
        <div class="presentInfo">
            <img class="presentImg" src="<?php echo $this->webroot ?>i_sp/present_a.jpg" width="300" height="200" alt="Pruduct name">
            <p class="presentText">選んだ商品は合っていますか？<br>
            次におねだり（復讐）する相手を選んで、<br>
            おねだりの準備を完了しましょう！</p>
        </div>
		<form>
        <div class="formList">
            <ul>
            	<li>
        		<input type="text" placeholder="@ ここに相手のTwitterアカウント名を入力" >
        		</li>
       		<div class="caption">
            	<p>商品はneda.lyが郵送であなたにお届けします。<br>
            	あなたの住所、もしくは希望の郵送先を入力して下さい♩
            	送信ボタンを押せばおねだりが完了します♩</p>
        	</div>
                <li>
                <label for="">宛名</label>
                <input type="text">
                </li>
                <li>
                <label for="">郵便番号</label>
                <input type="text">
                </li>
                <li>
                <label for="">住所</label>
                <input type="text">
                </li>
                <li>
                <label for="">電話番号</label>
                <input type="text">
                </li>
            </ul>
        </div>
        
        <div class="menu">
            <ul>
                <li><a href="<?php echo $this->webroot ?>Users/thankyou/">おねだり送信</a></li>
            </ul>
        </div>
        </form>
        </article>
    </div>
