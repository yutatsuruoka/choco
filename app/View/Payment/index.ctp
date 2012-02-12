<?php
    $this->set('html_body_id', 'contentsFlow10');
?>

    <div class="chocopayment">
        <div class="wrapper">
            <div class="paymentContainer">
                <div class="messageContainer">
                    <p class="message">チョコレートの決済方法を選択してください</p>
                </div>
                <div class="btnContainer clearfix">
                    <ul class="clearfix">
                        <li class="left"><a class="type01 over" href="<?php echo $this->webroot ?>Payment/bank"></a></li>
                        <li class="left"><a class="type02 last" href="<?php echo $this->webroot ?>Payment/paypal/<?php echo $post_id ?>/1"></a></li>
                    </ul>                       
                </div>
            </div>
        </div>
    </div>

</body>
</html>

