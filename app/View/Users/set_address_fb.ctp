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

    echo $this->Html->script('lists');
?>

<script language="javascript">
var lists = new Array();

// First set of text and values
lists['all']    = new Array(
<?php
    $c = 0;
    foreach ($friendIds['data'] as $fid ) {
        if ($c > 0) {
            echo ",";
        }
        $c ++;
        
        echo "'" . $fid['name'] . "'";
    }
?>
);

lists['male']    = new Array(
<?php
    $c = 0;
    foreach ($friendIds['male'] as $fid ) {
        if ($c > 0) {
            echo ",";
        }
        $c ++;
        
        echo "'" . $fid['name'] . "'";
    }
?>
);

lists['female']    = new Array(
<?php
    $c = 0;
    foreach ($friendIds['female'] as $fid ) {
        if ($c > 0) {
            echo ",";
        }
        $c ++;
        
        echo "'" . $fid['name'] . "'";
    }
?>
);
    
</script>

    <!-- ===== girl_2nd_fb ================================================================================================================================== -->
    <div class="girl_2nd wrapper" id="girl_2nd_fb">
        <div class="captionContainer mgb50">
            <p><img src="<?php echo $this->webroot ?>i/girl_2nd_fb_caption.png" alt="認証が無事に終わりました！あなたの送り先の住所を入力して、おねだりをする相手を選んで下さい。"></p>
        </div><!-- end wrapper captionContainer-->
        <article>
            <?php echo $this->Form->create('User', array('class'=>'formContainer clearfix', 'name' => 'User')); ?>	 
            <div class="formContainer clearfix">
                <div class="left">
                    <div class="presentImg">
                        <img src="<?php echo $this->webroot ?>i/present_<?php echo $post["Post"]['type'] ?>.jpg" alt="">
                    </div><!-- end left presentImg -->
                </div>
                 <div class="right">
                    <ul class="sheetContainer">
                        <li class="clearfix">
                        <div class="labelContainer"><label for="name">お名前</label></div>
                        <div class="inputContainer"><input type="text" title="例：キャリーぱみゅぱみゅ" class="jq-placeholder" id="user_name" name="user_name" value= <?php echo $user['User']['user_name'] ?>></div>
                        </li>
                        <li class="clearfix">
                        <div class="labelContainer"><label for="tel">郵便番号</label></div>
                        <div class="inputContainer"><input type="text" title="例：150-0002" class="jq-placeholder"  id="postal_code" name="postal_code" value= <?php echo $user['User']['postal_code'] ?>></div>
                        <li class="clearfix">
                        <div class="labelContainer"><label for="mail">住所</label></div>
                        <div class="inputContainer"><input type="text"  style="font-size:10px;" type="text" title="例：東京都渋谷区渋谷1-1 ※建物名、部屋番号を忘れずに！" class="jq-placeholder" id="address" name="address" value= <?php echo $user['User']['address'] ?>></div>
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

            <ul class="sex">
	    <li><input type="radio" name="sex" class="sex" value="全て" checked onchange="javascript:return changeList(document.forms['User'].fbname, lists['all']); ">全て</li>
            <li><input type="radio" name="sex" class="sex" value="男" onchange="javascript:return changeList(document.forms['User'].fbname, lists['male']); ">男</li>
	    <li><input type="radio" name="sex" class="sex" value="女" onchange="javascript:return changeList(document.forms['User'].fbname, lists['female']); ">女</li>
            </ul>

        <div class="fbList" >
            <form>
                <select id="fbname" name="fbname" style="">
                    <?php foreach ($friendIds['data'] as $fid) { ?>
                        <option value="<?php echo $fid['name']; ?>"><?php echo $fid['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="submit">
                <input id="fbSubmitBtn" value="" type="submit">
                <?php echo $this->Form->end(); ?>
            </div>
        </article>
    </div>
