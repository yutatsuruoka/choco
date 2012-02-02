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


<p style="text-align:center;"><br/><br/>If you are not automatically redirected to payment website within 5 seconds...<br/><br/>
<input type="submit" value="Click Here"></p>

</form>
</body>
</html>
