<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie" lang="jp"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie" lang="jp"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie" lang="jp"> <![endif]-->
<!--[if gt IE 8]>--> <html lang="jp"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <title>chocokure -Social Valentine platform-</title>
        <meta name="description" content="いつもねだられてばっかりの男子たち。今年のバレンタインは女子にねだってみよーぜ！そしてウハウハ過ごそうぜ！">
        <meta name="keywords" content="chocokure,バレンタイン,valentine,チョコ,家入一真,MONOspace">
        <meta name="author" content="家入一真 MONOspace">
        <link rel="stylesheet" href="<?php echo $this->webroot ?>c/reset.css"> 
        <link rel="stylesheet" href="<?php echo $this->webroot ?>c/style.css"> 
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body id="<?php echo $html_body_id ?>">
        <header>
        <div class="wrapper">
            <h1><a href="index.html"><img src="<?php echo $this->webroot ?>i/logo.png" alt="gimme choco Valentine's Day project"></a></h1> 
            <p class="caption"><img src="<?php echo $this->webroot ?>i/header_caption.png"  alt=""></p>
            <aside class="snsContainer clearfix">
            <div class="snsButton">   
                <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div><!-- end .snsContainer-->
            <div class="snsButton">
                <iframe src="//www.facebook.com/plugins/like.php?href=monosp.com&amp;send=false&amp;layout=button_count&amp;width=110&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;locale=en_US&amp;appId=201926619877324" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
            </div><!-- end .snsContainer-->
            </aside>
        </div><!-- end .wrapper -->
    </header>
    
    <?php echo $content_for_layout ?>
		
        <div id="socialContainer">
            <div class="wrapper clearfix">
            <div class="fbContainer">
                <div id="fb-root">
                </div>
                <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=154730981265676";
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-comments" data-href="http://google.com" data-num-posts="3" data-width="560"></div>
            </div>
            <div class="happyContainer">
                <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
                <script>
                    new TWTR.Widget({
                        version: 2,
                        type: 'search',
                        search: '#chocokure',
                        interval: 30000,
                        title: 'Social Valentine platform.',
                        subject: '#chocokure',
                        width: 390,
                        height: 400,
                        theme: {
                            shell: {
                                background: '#ffffff',
                                color: '#000000'
                            },
                            tweets: {
                                background: '#ffffff',
                                color: '#666666',
                                links: '#b7ff00'
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
        <footer>
        <div class="wrapper">
            <div class="createTeam clearfix">
                <div id="hiinc" class="team clearfix">
                    <div class="teamMember left clearfix">
                        <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon01.jpg"></div>
                        <div class="memberProfile left">
                            <p class="name">家入一真</p>
                            <p class="post">Hyperinternets<br>Programmer</p>
                        </div>
                        <ul class="memberSns left clearfix">
                            <li class="facebookIcon left"><a href="https://www.facebook.com/ieiri" target="_blank">facebook</a></li>
                            <li class="twitterIcon left"><a href="https://twitter.com/#!/hbkr" target="_blank">Twitter</a></li>
                        </ul>
                    </div><!-- end teamMember -->
                    <div class="teamMember left clearfix">
                        <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon02.jpg"></div>
                        <div class="memberProfile left">
                            <p class="name">名字名前</p>
                            <p class="post">Hyperinternets<br>Programmer</p>
                        </div>
                        <ul class="memberSns left clearfix">
                            <li class="facebookIcon left"><a href="https://www.facebook.com/ieiri" target="_blank">facebook</a></li>
                            <li class="twitterIcon left"><a href="https://twitter.com/#!/hbkr" target="_blank">Twitter</a></li>
                        </ul>
                    </div><!-- end teamMember -->
                    <div class="teamMember left clearfix">
                        <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon03.jpg"></div>
                        <div class="memberProfile left">
                            <p class="name">名字名前</p>
                            <p class="post">Hyperinternets<br>Programmer</p>
                        </div>
                        <ul class="memberSns left clearfix">
                            <li class="facebookIcon left"><a href="https://www.facebook.com/ieiri" target="_blank">facebook</a></li>
                            <li class="twitterIcon left"><a href="https://twitter.com/#!/hbkr" target="_blank">Twitter</a></li>
                        </ul>
                    </div><!-- end teamMember -->
                    <div class="teamMember left last clearfix">
                        <div class="memberIcon left"><img src="<?php echo $this->webroot ?>i/hiinc_icon04.jpg"></div>
                        <div class="memberProfile left">
                            <p class="name">鶴岡裕太</p>
                            <p class="post">Hyperinternets<br>Programmer</p>
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
                            <p class="post">MONOspace<br>web designer</p>
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
                            <p class="post">MONOspace<br>web designer</p>
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
                            <p class="post">MONOspace<br>Programmer</p>
                        </div>
                        <ul class="memberSns clearfix">
                            <li class="facebookIcon left"><a href="https://www.facebook.com/profile.php?id=100002491780831" target="_blank">facebook</a></li>
                            <li class="twitterIcon left"><a href="https://twitter.com/#!/Mogi_Satoshi" target="_blank">Twitter</a></li>
                        </ul>
                    </div><!-- end teamMember -->
                </div><!-- end #monosp -->
            </div><!-- end createTeam -->
            <ul class="info">
                <li><a href="">特定商取引法に基づく表記</a>&#12288;&#65372;&#12288;</li>
                <li><a href="">利用規約</a>&#12288;&#65372;&#12288;</li>
                <li><a href="">プライバシーポリシー</a>&#12288;&#65372;&#12288;</li>
                <li><a href="">運営会社</a>&#12288;&#65372;&#12288;</li>
                <li id="copyRight"><small>&copy;2012 <a href="http://warusou.com/" target="_blank">warusou</a>（Designed by <a href="http://monosp.com/" target="_blank">MONOspace</a>）</small></li>
            </ul>
        </div>
        </footer>
    <script type="text/javascript" src="<?php echo $this->webroot ?>j/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot ?>j/modernizr-2.0.6.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot ?>j/fixHeight.js"></script>
    <script type="text/javascript" src="<?php echo $this->webroot ?>j/script.js"></script>
      <!--[if lt IE 8 ]>
      <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
      <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
      <![endif]-->

    </body>
</html>
