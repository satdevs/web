<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
		<div class="box-header with-border">
			<div class="box-header">
				<div class="col-sm-12" style="margin-bottom: 20px;">
					<!--h3 id="form-top" ><?= __('1000 Mbps-os Internet Extra csomag igénylő adatlap') ?></h3-->
					<p id="error-message" class="text-left" style="display: none; padding: 3px 10px; margin-bottom: 5px; font-weight: bold; font-size: 16px;background: red; color: white;">
						Kérem javítsa a hibásan megadott adatokat!
					</p>
					<p id="error-messages" class="text-left" style="display: none; padding: 3px 10px; font-size: 16px; color: red; font-weight: bold;"></p>
				</div>
			</div>
		</div>

		<div class="box">

			<?php //debug($record->name) ?>
			<?php //debug($record) ?>
			<?php //die(); ?>

			<div style="clear: both;"></div>

			<div class="box-body">

				<div class="form-group">
					<h3 align="center">1000 Mbps-os Internet Extra csomag igénylése</h3>
					<p class="text-center">
						Felhívnánk figyelmét arra, hogy az igénylést csak abban az esetben tudja benyújtani, ha Önnek <b>Internet&nbsp;Extra&nbsp;csomag</b>ja van, <b>számláját&nbsp;elektronikusan&nbsp;igényli</b> (PDF) valamint <b>elektronikusan&nbsp;egyenlíti&nbsp;ki<b>.
					</p>
				</div>
				
				<?= $this->Form->create($internetextra, ['id'=>'internetextra', 'class'=>'form-horizontal']) ?>
				<?php
					//debug($pdfinvoice);
				?>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Előfizető neve:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'readonly'=>true, 'placeholder'=>'Számlán szereplő előfizetői név', 'value' => $record->name ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="custno" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Ügyfélszám:</label>
					<div class="col-sm-4">
						<?php echo $this->Form->input('custno', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'readonly'=>true, 'placeholder'=>'ID000000 formátumban', 'value' => $record->sub_id ]); ?>
					</div>
					<div class="col-sm-5" style="padding-top: 6px;">
						&larr;&nbsp;A számla bal felső sarkában található.
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Település:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('city', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'readonly'=>true, 'placeholder'=>'Számlázási cím település neve', 'value' => $record->city ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Cím:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('address', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'readonly'=>true, 'placeholder'=>'Számlázási cím: utca, házszám, emelet, ajtó', 'value' => $record->address ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Email:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('email', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'readonly'=>true, 'placeholder'=>'Lehetőleg NE adjon meg freemail-es vagy citromailes címet!', 'value' => $record->email ]); ?>
					</div>
				</div>

				<?php //debug($pdfinvoice); die();
					$accept = '';
					$cb1 = '';
					$cb5 = '';
					if($internetextra->accept){$accept=' checked';}
					if($internetextra->cb5){$cb5=' checked';}
				?>
				
				<div class="form-group" style="border-bottom: 0px solid lightgray; padding-bottom: 15px;">
					<label for="none" class="col-md-3 control-label">&nbsp;</label>
					<div id="div-accept-border" class="col-xs-12 col-sm-9 col-md-9 col-lg-9" style="border: 3px solid green;">
						<div id="div-accept" class="icheck-turquoise" style="border-bottom: 0px solid lightgray; padding-bottom: 10px; padding: 5px;">
							<input type="checkbox" id="accept" name="accept"<?= $accept ?> />
							<label for="accept"><span style="color: red; font-weight: bold;">*</span>&nbsp;Igen, szeretném igényelni az 1000 Mbps-os Internet Extra csomagot.<br><i style="color: green;">&nbsp;&nbsp;&nbsp;Kérem jelölje be a kis négyzetet!</i></label>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="none" class="col-md-3 control-label">&nbsp;</label>
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">

						<div id="div-cb5" class="icheck-turquoise" style="padding-bottom: 10px; padding-top: 10px; padding: 5px;">
							<input type="checkbox" id="cb5" name="cb5"<?= $cb5 ?> />
							<label for="cb5"><span style="color: red; font-weight: bold;">*</span>&nbsp;Adatkezelési szabályzatot elolvastam és tudomásul vettem.</label>
						</div>

						<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#gdprModal" style="margin: 10px auto;">
							Adatkezelési szabályzat elolvasása
						</button>
					</div>
				</div>

				<div class="box-footer text-center">
					<?php //= $this->Form->button('<i class="fa fa-fw fa-save"></i> Csomag igénylése', ?>
					<?= $this->Form->button('Csomag igénylése',
						['id'=>'submit', 'class'=>'btn btn-success', 'style'=>'padding: 30px; padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold; border: 2px solid green;']
					) ?>
					<div class="col-sm-10" style="margin: 20px; padding-top: 10px;"></div>
				</div>

				<?= $this->Form->end() ?>

			</div>
		</div>
	</div>

	
</div>

	<div class="col-sm-8 col-sm-pull-4" style="margin-top: -10px;">
		<img src="/images/shadow.png" style="width: 100%; height: 30px;" />
	</div>

<!-- Modal -->
<div class="modal fade" id="gdprModal" tabindex="-1" role="dialog" aria-labelledby="gdpeLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gdpeLabel"><?= $gdpr_title ?></h4>
      </div>
      <div class="modal-body">
        <?= $gdpr_body ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Elolvastam</button>
      </div>
    </div>
  </div>
</div>


<!-- -------------------------------- /FORM -------------------------------- -->
<script>
<?php //https://www.sitepoint.com/jquery-basic-regex-selector-examples/ ?>
$(document).ready( function(){

	$('#submit').click( function(event){
		var ret = true;
		var errorList = "";

		if($("#accept").is(":checked")){
			$("#div-accept").css('background','#dfd');
			$("#div-accept-border").css('borderColor','green');
		}else{
			errorList = errorList + "• Kérem jelölje be a jelölőnégyzetet, hogy igényi az 1000 Mbps-os Internet csomagot!<br>";
			$("#div-accept").css('background','#fdd');
			$("#div-accept-border").css('borderColor','red');
			ret = false;
		}

		if($("#cb5").is(":checked")){
			$("#div-cb5").css('background','#dfd');
		}else{
			errorList = errorList + '• Miután elolvasta az adatkezelési nyilatkozatot kérjük, jelölje be a jelölőnégyzetet!<br>';
			$("#div-cb5").css('background','#fdd');
			ret = false;
		}

		if(!ret){
			$("#error-message").show(1500);
			$("#error-messages").fadeIn(3000);
			$("#error-messages").html(errorList);
			$([document.documentElement, document.body]).animate({
				scrollTop: $("body").offset().top
			}, 1000);
		}else{
			$("#error-message").hide(1000);
			$("#error-messages").fadeOut(1000);
		}

		return ret;
	});

});
</script>
