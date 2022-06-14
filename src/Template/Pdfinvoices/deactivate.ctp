<?php
	//debug($this->request);
?>
<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
		<div class="box">
			<div style="clear: both;"></div>
			<div class="box-body">
				<h2>Valóban deaktiválni szeretné a PDF számla igényét?</h2>

				<br />

				<div id="div-confirmed" class="icheck-turquoise" style="padding-bottom: 10px; padding: 5px;">
					<input type="checkbox" id="confirmed" name="confirmed" />
					<label for="confirmed"><span style="color: red; font-weight: bold;">*</span>&nbsp;Deaktiváláshoz kérem jelölje be.</label>
				</div>

				<br />

				<div class="box-footer" id="buttons" style="display: none;">
					<a href="/pdfdeactivate-confirmed/<?= $hash ?>" class="btn btn-default" style="padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold;">PDF számla deaktiválása</a>
					<a href="/" class="btn btn-success" style="padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold;">Mégsem</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready( function(){

	$('#confirmed').click( function(event){
		if($("#confirmed").is(":checked")){
			$("#buttons").show(500);
		}else{
			$("#buttons").hide(500);
		}
	});

});
</script>
