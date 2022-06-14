<?php if($uploads!=Null){ ?>
<div id="downloadable-documents">
	<h2 class="text-center">Letölthető dokumentumok</h2>
	<?php //debug($uploads); ?>
	<ul style="list-style-type: square;">
	<?php foreach ($uploads as $upload) { ?>
		<li><a href="/download/<?= $upload['hash'] ?>"><?= $upload['name'] ?></a></li>
	<?php } //ForEach ?>
	</ul>
</div>
<?php } //IF ?>