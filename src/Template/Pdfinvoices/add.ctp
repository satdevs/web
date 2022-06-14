<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
		<div class="box-header with-border">
			<div class="box-header">
				<div class="col-sm-12" style="margin-bottom: 20px;">
					<h3 id="form-top" ><?= __('PDF számla igénylő adatlap') ?></h3>
					<p id="error-message" class="text-left" style="display: none; padding: 3px 10px; margin-bottom: 5px; font-weight: bold; font-size: 16px;background: red; color: white;">
						Kérem javítsa a hibásan megadott adatokat!
					</p>
					<p id="error-messages" class="text-left" style="display: none; padding: 3px 10px; font-size: 16px; color: red; font-weight: bold;"></p>
				</div>
			</div>
		</div>

		<div class="box">

			<div style="clear: both;"></div>

			<div class="box-body">

				<?= $this->Form->create($pdfinvoice, ['id'=>'pdfszamla', 'class'=>'form-horizontal']) ?>
				<?php
					//debug($pdfinvoice);
				?>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Előfizető neve:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false, 'placeholder'=>'Számlán szereplő előfizetői név' ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="sub_id" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Ügyfélszám:</label>
					<div class="col-sm-4">
						<?php echo $this->Form->input('sub_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'ID000000 formátumban' ]); ?>
					</div>
					<div class="col-sm-5" style="padding-top: 6px;">
						&larr;&nbsp;A számla bal felső sarkában található.
					</div>
				</div>
				<div class="form-group" style="border-top: 1px solid lightgray; padding-top: 5px;">
					<h4 class="text-center">Számlázási cím</h4>
					<label for="email" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Email:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('email', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Lehetőleg NE adjon meg freemail-es vagy citromailes címet!' ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Település:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('city', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Számlázási cím település neve' ]); ?>
					</div>
				</div>
				<div class="form-group" style="border-bottom: 1px solid lightgray; padding-bottom: 15px;">
					<label for="address" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Cím:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('address', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Számlázási cím: utca, házszám, emelet, ajtó' ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Telefonszám:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('phone', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'06201234567 formátumban, csak számokat adjon meg' ]); ?><br>
						<div style="font-size: 12px; color: red; margin-top: -15px; margin-bottom: 10px;">
							Kérjük ne felejtse el megadni az előhívó számokat (<b>06</b> vagy <b>+36</b>)
							vagy a külföldi számok esetén a nemzetközi előhívó számot a <b>+</b> jel után. <i>(Pl.:&nbsp;Egyesült&nbsp;Királyság&nbsp;+44, Ausztria:&nbsp;+43)</i>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="type" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Típusa:</label>
					<div class="col-sm-5">
						<?php
							$types = ['MAGÁNSZEMÉLY'=>'Magánszemély', 'INTÉZMÉNY'=>'Intézmény', 'CÉG'=>'Cég'];
							$selected = 'MAGÁNSZEMÉLY';
							if(isset($pdfinvoice->type)){
								$selected = $pdfinvoice->type;
							}
						?>
						<?php echo $this->Form->input('type', ['options'=>$types, 'selected'=>$selected, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'06201234567 formátumban, csak számokat adjon meg' ]); ?>
					</div>
				</div>
				<div class="form-group" id="row-taxnumber" style="display: none;">
					<label for="taxnumber" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Adószám:</label>
					<div class="col-sm-5">
						<?php
							$taxnumber = '';
							if(isset($pdfinvoice->taxnumber) && $pdfinvoice->taxnumber != '-'){
								$taxnumber = $pdfinvoice->taxnumber;
							}
						?>
						<?php echo $this->Form->input('taxnumber', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Formátum: 12345678-2-22', 'value'=>$taxnumber ]); ?>
					</div>
				</div>

				<?php //debug($pdfinvoice); die();
					$cb1 = '';
					$cb2 = '';
					$cb3 = '';
					$cb4 = '';
					$cb5 = '';
					if($pdfinvoice->cb1){$cb1=' checked';}
					if($pdfinvoice->cb2){$cb2=' checked';}
					if($pdfinvoice->cb3){$cb3=' checked';}
					if($pdfinvoice->cb4){$cb4=' checked';}
					if($pdfinvoice->cb5){$cb5=' checked';}
				?>

				<div class="form-group">
					<label for="none" class="col-md-3 control-label">&nbsp;</label>
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<div id="div-cb1" class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding: 5px;">
							<input type="checkbox" id="cb1" name="cb1"<?= $cb1 ?> />
							<label for="cb1"><span style="color: red; font-weight: bold;">*</span>&nbsp;Hozzájárulok, hogy a Sághy-Sat Kft a szolgáltatáshoz kapcsolódó információkkal megkeressen.</label>
						</div>
						<div class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding-top: 10px; padding: 5px;">
							<input type="checkbox" id="cb2" name="cb2"<?= $cb2 ?> />
							<label for="cb2">Hozzájárulok, hogy a Sághy-Sat Kft. marketing ajánlatokkal Email-ben megkeressen.</label>
						</div>
						<div class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding-top: 10px; padding: 5px;">
							<input type="checkbox" id="cb3" name="cb3"<?= $cb3 ?> />
							<label for="cb3">Hozzájárulok, hogy a megadott adatokat 3. félnek átadjuk marketing szempontjából.</label>
						</div>
						<div id="div-cb4" class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding-top: 10px; padding: 5px;">
							<input type="checkbox" id="cb4" name="cb4"<?= $cb4 ?> />
							<label for="cb4"><span style="color: red; font-weight: bold;">*</span>&nbsp;Hozzájárulok, hogy a megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressenek.</label>
						</div>
						<div id="div-cb5" class="icheck-turquoise" style="padding-bottom: 10px; padding-top: 10px; padding: 5px;">
							<input type="checkbox" id="cb5" name="cb5"<?= $cb5 ?> />
							<label for="cb5"><span style="color: red; font-weight: bold;">*</span>&nbsp;Adatkezelési szabályzatot elolvastam és tudomásul vettem.</label>
						</div>

						<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#gdprModal" style="margin: 10px auto;">
							Adatkezelési szabályzat elolvasása
						</button>
					</div>
				</div>

				<div class="form-group" style="width: 98%; margin: 20px auto;">
					<label for="group_id" class="col-sm-12 control-label" style="text-align: center;">Biztonsági kód:</label>
					<div class="col-sm-10" style='font-family: "Courier New"; font-size: 12px; border: 1px solid red; width: 100%; line-height: 5px; padding: 10px; text-align: center; font-size: 10px; letter-spacing: -1px; background: red;'>
						<?= $captcha ?>
					</div>
				</div>

				<div class="form-group">
					<label for="captcha" class="col-sm-12" style="color: red;"><span style="color: red; font-weight: bold;">*</span>&nbsp;Írja be a fentebb olvasható biztonsági a kódot:</label>
					<div class="col-sm-12">
						<?php echo $this->Form->input('captcha', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'border: 1px solid red;' ]); ?>
					</div>
				</div>

				<div class="box-footer">
					<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Kattintson ide a PDF számla igényléséhez',
						['id'=>'submit', 'class'=>'btn btn-success', 'style'=>'width: 100%; padding-top: 20px; padding-bottom: 20px; font-size: 16px; font-weight: bold;']
					) ?>
					<div class="col-sm-10" style="margin: 20px; padding-top: 10px;">
					</div>
				</div>

				<?= $this->Form->end() ?>

			</div>
		</div>
	</div>
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

	if($('#type').val() != 'MAGÁNSZEMÉLY'){
		$('#row-taxnumber').show(500);
	}else{
		$('#row-taxnumber').hide(500);
	}

	$('#type').change( function(){

		if($('#type').val() != 'MAGÁNSZEMÉLY'){
			$('#row-taxnumber').show(500);
		}else{
			$('#row-taxnumber').hide(500);
		}

	});


	$('#name').blur( function(event){
		//var fullNameRegex = /^[a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]{3,30}$/i;
		//var fullNameRegex = /^[a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]+(([',. -][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó ])?[a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]*)*$/g;
		var fullNameRegex = /^[A-ZÍÉÁŰŐÚÖÜÓ][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]{3,}(?: [A-ZÍÉÁŰŐÚÖÜÓ][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]*){0,2}$/i;
		var fullName = $("#name").val();
		var n = fullName.indexOf(" ");
		if(n > 0){
			if($("#name").val()==''){
				$("#name").css('background','#fdd');
			}else{
				$("#name").css('background','#dfd');
			}
			/*
			if(!fullNameRegex.test(fullName)) {
				$("#name").css('background','#fdd');
			}else{
				$("#name").css('background','#dfd');
			}
			*/
		}else{
			$("#name").css('background','#fdd');
		}
	});

	$('#sub-id').blur( function(event){
		var subIdRegex = /^[I]{1}[D]{1}[0-9]{6}$/i;
		var subId = $("#sub-id").val();
		if(!subIdRegex.test(subId)){
			$("#sub-id").css('background','#fdd');
		}else{
			$("#sub-id").css('background','#dfd');
		}
	});

	$('#email').blur( function(event){
		var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		var email = $("#email").val();
		if(!emailRegex.test(email)){
			$("#email").css('background','#fdd');
		}else{
			$("#email").css('background','#dfd');
		}
	});

	$('#city').blur( function(event){
		var cityRegexp = /^[A-ZÍÉÁŰŐÚÖÜÓ]{1}[a-zíéáűőúöüó]+$/i;
		var city = $("#city").val();
		if(!cityRegexp.test(city)){
			$("#city").css('background','#fdd');
		}else{
			$("#city").css('background','#dfd');
		}
	});

	$('#address').blur( function(event){
		var addressRegexp = /^[A-Za-z0-9íéáűőúöüóÍÉÁŰŐÚÖÜÓ\.\,\-\ ]+$/i;
		var address = $("#address").val();
		if(!addressRegexp.test(address)){
			$("#address").css('background','#fdd');
		}else{
			$("#address").css('background','#dfd');
		}
	});

	$('#phone').blur( function(event){
		var phoneNumberRegex = /^[0-9\+\-()]{6,20}$/i;
		var phone = $("#phone").val();
		if(!phoneNumberRegex.test(phone)){
			$("#phone").css('background','#fdd');
		}else{
			$("#phone").css('background','#dfd');
		}
	});

	$('#captcha').blur( function(event){
		var captchaRegex = /^[A-Za-z0-9íéáűőúöüóÍÉÁŰŐÚÖÜÓ]{3}$/i;
		var captcha = $("#captcha").val();
		if(!captchaRegex.test(captcha)){
			$("#captcha").css('background','#fdd');
		}else{
			$("#captcha").css('background','#dfd');
		}
	});

	$('#submit').click( function(event){
		var ret = true;
		var errorList = "";
		//var fullNameRegex = /^[A-Z][a-zA-Z]{3,}(?: [A-Z][a-zA-Z]*){0,2}$/i;
		//var fullNameRegex = /^[a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]+(([',. -][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó ])?[a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]*)*$/g;
		var fullNameRegex = /^[A-ZÍÉÁŰŐÚÖÜÓ][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]{3,}(?: [A-ZÍÉÁŰŐÚÖÜÓ][a-zA-ZÍÉÁŰŐÚÖÜÓíéáűőúöüó]*){0,2}$/i;
		var subIdRegex = /^[I][D][0-9]{6}$/i;
		var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
		var cityRegexp = /^[A-Z][a-z]+$/i;
		var addressRegexp = /^[A-Z][0-9a-zA-Z]+$/i;
		var phoneNumberRegex = /^[0-9-()+]{3,20}$/i;
		var captchaRegex = /^[A-Za-z0-9íéáűőúöüóÍÉÁŰŐÚÖÜÓ]{3}$/i;

		var fullName = $("#name").val();
		var n = fullName.indexOf(" ");
		if(n > 0){
			if($("#name").val()==''){
				errorList = errorList + "• Kérem írja be a nevét!<br>";
				$("#name").css('background','#fdd');
				ret = false;
			}else{
				$("#name").css('background','#dfd');
			}
			/*
			if(!fullNameRegex.test($("#name").val())) {
				errorList = errorList + "• A neve érvénytelen karaktereket tartalmaz!<br>Kérem, hogy csak betűket használjon!<br>";
				$("#name").css('background','#fdd');
				ret = false;
			}else{
				$("#name").css('background','#dfd');
			}
			*/
		}else{
			errorList = errorList + "• Kérem a teljes nevét adja meg!<br>";
			$("#name").focus();
			$("#name").css('background','#fdd');
			ret = false;
		}

		if(!subIdRegex.test($("#sub-id").val())) {
			errorList = errorList + "• Az ügyfélszáma érvénytelen karakterekt tartalmaz! Az ID után csak számok állhatnak!<br>";
			$("#sub-id").css('background','#fdd');
			ret = false;
		}else{
			$("#sub-id").css('background','#dfd');
		}

		if( !emailRegex.test( $("#email").val() ) ) {
			errorList = errorList + "• Érvénytelen a megadott Email cím! Kérem javítsa!<br>";
			$("#email").css('background','#fdd');
			ret = false;
		}else{
			$("#email").css('background','#dfd');
		}

		if( $("#city").val()=='' ) {
			errorList = errorList + "• Érvénytelen karaktereket tartalmaz a településnév!<br>";
			$("#city").css('background','#fdd');
			ret = false;
		}else{
			$("#city").css('background','#dfd');
		}

		//if( !addressRegexp.test( $("#address").val() ) ){
		if($("#address").val()==''){
			errorList = errorList + "• Érvénytelen karaktereket tartalmaz a cím!<br>";
			$("#address").css('background','#fdd');
			ret = false;
		}else{
			$("#address").css('background','#dfd');
		}

		//if( !phoneNumberRegex.test( $("#phone").val() ) ){
		if( $("#phone").val()=='' ){
			errorList = errorList + "• Érvénytelen karaktereket tartalmaz a telefonszám!<br>";
			$("#phone").css('background','#fdd');
			ret = false;
		}else{
			$("#phone").css('background','#dfd');
		}

		// #################################################################################s

		if($("#cb1").is(":checked")){
			$("#div-cb1").css('background','#dfd');
		}else{
			errorList = errorList + "• Az 1. jelölő négyzetet kötelező bejelölni!<br>";
			$("#div-cb1").css('background','#fdd');
			ret = false;
		}

		if($("#cb4").is(":checked")){
			$("#div-cb4").css('background','#dfd');
		}else{
			errorList = errorList + "• A 4. jelölő négyzetet kötelező bejelölni!<br>";
			$("#div-cb4").css('background','#fdd');
			ret = false;
		}
		if($("#cb5").is(":checked")){
			$("#div-cb5").css('background','#dfd');
		}else{
			errorList = errorList + "• Az 5. jelölő négyzetet kötelező bejelölni!<br>";
			$("#div-cb5").css('background','#fdd');
			ret = false;
		}

		// #################################################################################s
		var captcha = $("#captcha").val();
		if(!captchaRegex.test(captcha)){
			$("#captcha").css('background','#fdd');
			errorList = errorList + "• Kérem írja be a piros területen látható biztonsági kódot!<br>";
			ret = false;
		}else{
			$("#captcha").css('background','#dfd');
		}
		// #################################################################################s

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

		//return false;
		return ret;
	});

});
</script>

