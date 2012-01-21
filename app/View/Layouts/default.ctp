<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>
<?php echo $this->action == 'index' ? '' : $title_for_layout . ' | ' ?>Choco</title>
<link rel="stylesheet" href="<?php echo $this->webroot ?>css/style.css" />
</head>
<body>
<header>
<?php 
if($this->Session->check("Message.flash")){
	echo '<div id="flashWrapper">';
	echo $this->Session->flash();
	echo '</div>';
	echo $this->Html->script('jquery/jquery-1.6.2.min');
	echo $this->Html->script('application');
}
?>
<div class = "cen">
	<h1>チョコくれ</h1>
</div>
</header>
<?php echo $content_for_layout ?>
<footer>
</footer>
</body>
</html>