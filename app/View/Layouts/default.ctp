<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="jp"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="jp"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="jp"> <![endif]-->
<!--[if gt IE 8]-> <html class="no-js" lang="jp"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>chocokure -social white day platform- </title>
    <meta name="description" content="チョコくれ！が女性の為に帰ってきたぜ！！男性におねだり（復讐）できるソーシャルホワイトデープラットフォーム">
    <meta name="keywords" content="chocokure,ホワイトデー,ソーシャルホワイトデー,チョコ,家入一真,MONOspace">
    <meta name="author" content="家入一真 ワルソウ MONOspace">
    <meta name="viewport" content="width=device-width">
    <link rel="apple-touch-icon" href="i/apple-touch-icon-precomposed.png">
    <meta property="og:title" content="neda.ly at chocokure white day ver.">
    <meta property="og:description" content="チョコくれ！が女性の為に帰ってきたぜ！！男性におねだり（復讐）できるソーシャルホワイトデープラットフォーム">
    <meta property="og:url" content="http://nedaly.com/">
    <meta property="og:image" content="http://nedaly.com/i/fb_link_img.jpg">
    <meta property="og:type" content="website" />    
    <link rel="stylesheet" href="<?php echo $this->webroot ?>c/colorbox.css">
    <link rel="stylesheet" href="<?php echo $this->webroot ?>c/style.css">
    
    <!--[if lt IE 9]>
    <script src="j/libs/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
</head>
 <body id="<?php echo $html_body_id ?>" <?php if ($html_body_id == 'contentsFlow07') echo "onLoad=\"document.forms['gateway_form'].submit();\""; ?>>
    <!-- ===== header ================================================================================================================================== -->
    <div class="wrapper">
        <header>
        <h1><a href="/"><img src="<?php echo $this->webroot ?>i/logo.png" alt="chocokure social white day platform"></a></h1>
        <aside class="snsContainer clearfix">
        <div class="snsButton left">   
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://chocokure.com/" data-text="【チョコくれ】ソーシャルバレンタインプラットフォーム-“次は女性たちの復讐が待ってるぞ”" data-hashtags="chocokure">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div><!-- end .snsButton-->
        <div class="snsButton left">
            <div id="fb-root"></div>
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fchocokure.com%2F&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=312737992072908" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
        </div><!-- end .snsButton-->
        </aside><!-- end .snsContainer-->
        </header>
    </div><!-- end wrapper -->
    
    
    
    <?php echo $content_for_layout ?>
		
		
		
	     <!-- ===== infoSnsContainer ================================================================================================================================== -->
    <div id="infoSnsContainer" class="wrapper clearfix">
        <div class="left leftContainer">
            <dl>
                <dt>chocokure2nd NEWS</dt>
                <dd>・pennolsonに掲載されました！</dd>
                <dd>・yahoo!ニュースに掲載されました！</dd>
                <dd>・ねとらぼに掲載されました！</dd>
                <dd>・RBBTODAYに掲載されました！</dd>
                <dd>・2012/02/03 リリースしました！</dd>
            </dl>
            <dl>
                <dt>chocokure2nd FUTURE</dt>
                <dd>・ホワイトデー復讐機能</dd>
                <dd>・おねだりボーイズ機能</dd>
                <dd>・おねだりマスカッツと提携</dd>
                <dd>・ソーシャルおねだりプラットフォーム化</dd>
            </dl>
            <dl>
                <dt>chocokure1st NEWS</dt>
                <dd>・pennolsonに掲載されました！</dd>
                <dd>・yahoo!ニュースに掲載されました！</dd>
                <dd>・ねとらぼに掲載されました！</dd>
                <dd>・RBBTODAYに掲載されました！</dd>
                <dd>・2012/02/03 リリースしました！</dd>
            </dl>
            <dl>
                <dt>chocokure1st FUTURE</dt>
                <dd>・ホワイトデー復讐機能</dd>
                <dd>・おねだりボーイズ機能</dd>
                <dd>・おねだりマスカッツと提携</dd>
                <dd>・ソーシャルおねだりプラットフォーム化</dd>
            </dl>
        </div>
        <div class="right rightContainer">
            <div class="onedariContainer clearfix">
                <h2>新着おねだりガール</h2>
                <ul class="twList clearfix">
            	    <?php
                        foreach ($girls as $girl ) {
                            echo '<li>';
                            /* echo '<a href=\'https://twitter.com/#!/' . $girl['screen_name'] . '\'>'; */
                            echo '<img src="' . $girl['avatar'] . '" width="50" height="50">';
                            echo '</a>';
                            echo "</li>\n";
                        }
					?>
                </ul>
              </div>
        </div>
        <div class="snsContainer clearfix">
            <div class="fbContainer left">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fwarusou&amp;width=350&amp;height=350&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23cccccc&amp;stream=false&amp;header=true&amp;appId=149485031807635" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:350px;" allowTransparency="true"></iframe>
            </div>
            <div class="twContainer right">
                <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
                <script>
                    new TWTR.Widget({
                        version: 2,
                        type: 'search',
                        search: '#chocokure',
                        interval: 30000,
                        title: 'Social Valentine platform.',
                        subject: '#chocokure',
                        width: 348,
                        height: 258,
                        theme: {
                            shell: {
                                background: '#ffffff',
                                color: '#000000'
                            },
                            tweets: {
                                background: '#ffffff',
                                color: '#666666',
                                links: '#ff99cc'
                            }
                        },
                        features: {
                            scrollbar: false,
                            loop: true,
                            live: true,
                            behavior: 'default'
                        }
                    }).render().start();
                </script>            
            </div>
        </div>
    </div>
    </div>
    <footer>	
    <div class="createTeam wrapper clearfix">
        <div id="hiinc" class="team clearfix">
            <div class="teamMember left clearfix">
                <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon01.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">家入一真</p>
                    <p class="post"><a href="http://hiinc.jp/" target="_blank">hyperinternets</a><br>Producer</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/ieiri" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/hbkr" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
            <div class="teamMember left clearfix">
                <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon02.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">アントニオ</p>
                    <p class="post"><br>Programmer</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/akamiya" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/antonio_kamiya" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
            <div class="teamMember left clearfix">
                <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon03.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">越後龍一</p>
                    <p class="post"><a href="http://hiinc.jp/" target="_blank">hyperinternets</a><br>AD</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/echigoryuichi" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/tebasakidaisuki" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
            <div class="teamMember left last clearfix">
                <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon04.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">鶴岡裕太</p>
                    <p class="post"><a href="http://hiinc.jp/" target="_blank">hyperinternets</a><br>Programmer</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/yuta.tsuruoka" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/0Q7" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
        </div><!-- end #hiinc -->
        <div id="monosp" class="team clearfix">
            <div class="teamMember left clearfix">
                <div class="memberIcon"><img src="<?php echo $this->webroot ?>i/monosp_icon01.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">板橋聡</p>
                    <p class="post"><a href="http://monosp.com/" target="_blank">MONOspace</a><br>Web Designer</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/profile.php?id=100001862109715" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/satoru_itabashi" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
            <div class="teamMember left clearfix">
                <div class="memberIcon"><img src="<?php echo $this->webroot ?>i/monosp_icon02.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">菊川実紀</p>
                    <p class="post"><a href="http://monosp.com/" target="_blank">MONOspace</a><br>Web Designer</p>
                </div>
                <ul class="memberSns left clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/minocolor" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/minocolor" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
            <div class="teamMember left clearfix">
                <div class="memberIcon"><img src="<?php echo $this->webroot ?>i/monosp_icon03.jpg"></div>
                <div class="memberProfile left">
                    <p class="name">茂木聡嗣</p>
                    <p class="post"><a href="http://monosp.com/" target="_blank">MONOspace</a><br>Programmer</p>
                </div>
                <ul class="memberSns clearfix">
                    <li class="facebookIcon left"><a href="https://www.facebook.com/profile.php?id=100002491780831" target="_blank">facebook</a></li>
                    <li class="twitterIcon left"><a href="https://twitter.com/#!/Mogi_Satoshi" target="_blank">Twitter</a></li>
                </ul>
            </div><!-- end teamMember -->
        </div><!-- end #monosp -->
    </div><!-- end createTeam -->
    <ul class="info">
        <li><a class="ajax" href="<?php echo $this->webroot ?>popup01.html">特定商取引法に基づく表記</a>&#12288;&#65372;&#12288;</li>
        <li><a class="ajax" href="<?php echo $this->webroot ?>popup02.html">会員利用規約</a>&#12288;&#65372;&#12288;</li>
        <li><a class="ajax" href="<?php echo $this->webroot ?>popup03.html">プライバシーポリシー</a>&#12288;&#65372;&#12288;</li>
        <li id="copyRight"><small>&copy;2012 <a href="http://warusou.com/" target="_blank">ワルソウ</a>（Designed by <a href="http://monosp.com/" target="_blank">MONOspace</a>）</small>&#12288;&#65372;&#12288;</li>
        <li><a href="http://camp-fire.jp" target="_blank" title="クラウドファンディング">CAMPFIRE - クラウドファンディング</a></li>
    </ul>
    </footer>
    <!-- anal -->
	<script type="text/javascript">
	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-23653112-9']);
  	_gaq.push(['_trackPageview']);
  	(function() {
    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();
	</script>
	<!-- end anal -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="j/libs/jquery-1.7.1.min.js"><\/script>')</script> 
    <script src="<?php echo $this->webroot ?>j/libs/jquery.ah-placeholder.js"></script>
    <script src="<?php echo $this->webroot ?>j/libs/fixHeight.js"></script>
    <script src="<?php echo $this->webroot ?>j/libs/jquery.colorbox-min.js"></script>
    <script src="<?php echo $this->webroot ?>j/script.js"></script>

    <script>
        var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

</body>
</html>
