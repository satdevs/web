<?php
	$karbantartas = false;
?>
<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
			<div class="box">
				<div style="clear: both;"></div>
				<div class="box-body">
<?php if($karbantartas){ ?>
					<h2>Karbantartás!<br>Kérem nézzen vissza picit később!</h2>
<?php }else{ ?>
					<h2><?= $text_title ?></h2>
					<?= $text_body ?>
					<br />
					<div class="box-footer">
						<a href="/pdfszamla-adatlap" class="btn btn-success" style="width: 100%; padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold;">PDF számla igénylése</a>
					</div>
<?php } ?>

				</div>
			</div>
	</div>
</div>

