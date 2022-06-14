<?php if(isset($text) && $text!=Null){ ?>
<div id="text">
	<h3 class="text-center"><?= $text['title'] ?></h3>
	<?= preg_replace("/ Ft/","&nbsp;Ft",$text['text']) ?>
</div>
<?php } ?>