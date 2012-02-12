<?php
    $this->set('html_body_id', 'contentsFlow07');
?>

<form method="POST" name="gateway_form" action="<?php echo $gatewayUrl ?>">

<?php
foreach ($fields as $name => $value)
{
        echo "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
}
?>


<p style="text-align:center;"><br/><br/>５秒後に自動的に決済画面に移動します。移動しない場合は下のボタンをクリックしてください。<br/><br/>
<input type="submit" value="決済画面に移動する"></p>

</form>
</body>
</html>