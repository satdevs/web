<?php /*
<pre>
<?php print_r($_SESSION); ?>
</pre>
*/ ?>
<div class="col-sm-8 col-sm-pull-4" style="border: 1px solid #ddd; padding: 10px;">
	<div class="blog">
		<div class="box-header with-border">
			<div class="box-header">
				<div class="col-sm-12" style="margin-bottom: 20px;">
					<h3 id="form-top" class="text-center"><?= __('<b>Igénybejelentés</b><br>
						501/2020. (XI. 14.) Korm. rendelete szerinti<br>
						<b>ingyenes internet-hozzáférési szolgáltatás igénybevételére</b>') ?></h3>
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
			
			<p>I. Alulírott jogosult az 501/2020. (XI. 14.) Korm. rendelete szerinti ingyenes internet-hozzáférési szolgáltatás igénybevételére vonatkozó igényemet az alábbi adatok megadásával jelzem a hírközlési szolgáltató felé.</p>
			
				<?= $this->Form->create($freeinternet,['class'=>'form-horizontal']) ?>

				<h4 class="text-center">II. Jogosultsággal érintett előfizetés adatai</h4>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;1. Előfizető neve:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Előfizető neve" 
							 data-content="A számlán szereplő előfizetői teljes név."
							 data-trigger="hover"
						/>
					</div>
				</div>
				<div class="form-group">
					<label for="sub_id" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;2. Ügyfélszám:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('sub_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 6px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Ügyfélszám" 
							 data-content="A számla bal felső sarkában található (ID00... kezdetű)."
							 data-trigger="hover"
						/>
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;3. Település:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('city', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Település neve" 
							 data-content="Számlán szereplő településnév"
							 data-trigger="hover"
						 />
					</div>
				</div>
				<div class="form-group" style="border-bottom: 1px solid lightgray; padding-bottom: 15px;">
					<label for="address" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;3. Cím:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('address', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Szolgáltatás előfizetői szerződés szerinti igénybevételi helye" 
							 data-content="Földrajzi cím megadása szükséges: közterület neve, házszám, és ha van emelet, ajtó feltüntetése"
							 data-trigger="hover"
						 />
					</div>
				</div>

				<h4 class="text-center">III. Jogosult és jogosultság adatai</h4>
				<div class="form-group">
					<label for="name" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;1. Jogosult neve:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Jogosultságot megalapozó érvényes diák/pedagógus igazolvány szerinti név" 
							 data-content="A III.2. pontban megjelölt jogcímen igényt bejelentő személy neve."							 
							 data-trigger="hover"
						/>						
					</div>
				</div>
				<div class="form-group">
					<label for="type" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;2. Jogosultság jogcíme:</label>
					<div class="col-sm-6">
						<?php
							$titles = [
								1 =>'Tanuló', 
								2 =>'Tanuló II.1. szerinti törvényes képviselője', 
								3 =>'Tanuló által használt előfizetés II.1. szerinti előfizetője', 
								4 =>'Pedagógus-oktató', 
								5 =>'Pedagógus-oktató által használt előfizetés II.1. szerinti előfizetője', 
							];
							
							$selected = '1';
							if(isset($freeinternet->type)){
								$selected = $freeinternet->type;
							}
						?>
						<?php echo $this->Form->input('entitled_title_id', ['options'=>$titles, 'selected'=>$selected, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Jogosultság jogcíme" 
							 data-content="A megfelelő válasz megjelölendő"
							 data-trigger="hover"
						/>						
					</div>					
				</div>
				<div class="form-group">
					<label for="student_card_number" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;3.&nbsp;Igazolványon&nbsp;lévő&nbsp;név:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_card_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Igazolványon&nbsp;lévő&nbsp;név" 
							 data-content="Jogosultságot megalapozó érvényes diák/pedagógus igazolvány szerinti név."
							 data-trigger="hover"
						/>						
					</div>
				</div>
				<div class="form-group">
					<label for="student_card_number" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;4.&nbsp;Igazolvány&nbsp;száma:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_card_number', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Igazolvány&nbsp;száma" 
							 data-content="Jogosultságot megalapozó érvényes diák/pedagógus igazolvány szerinti oktatási azonosítószáma (11 jegyű OM szám)."
							 data-trigger="hover"
						/>						
					</div>
				</div>


				
				
				<div class="form-group">
					<label for="city" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;5. Település:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_city', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Ingyenes szolgáltatás igénybevételi helye" 
							 data-content="Település neve"
							 data-trigger="hover"
						 />					
					</div>
				</div>
				<div class="form-group" style="padding-bottom: 15px;">
					<label for="address" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;5. Cím:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_address', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Ingyenes szolgáltatás igénybevételi helye" 
							 data-content="A jogosult lakóhelye, tartózkodási helye vagy szálláshelye szerinti helyek közül egy jogosultság alapján csak egy helyen veheti a szolgáltatást ingyenesen igénybe. Földrajzi cím megadása szükséges: közterület neve, házszám, és ha van emelet, ajtó feltüntetése."
							 data-trigger="hover"
						/>						
					</div>
				</div>


				<div class="form-group">
					<label for="entitled_institutionname" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Okt. int. neve:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_institution_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Okt.&nbsp;int.&nbsp;neve" 
							 data-content="Jogosultságot megalapozó középfokú oktatási intézmény neve."
							 data-trigger="hover"
						/>						
					</div>
				</div>
				<div class="form-group">
					<label for="entitled_nstitution_OM" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Okt. int. OM száma:</label>
					<div class="col-sm-6">
						<?php echo $this->Form->input('entitled_institution_OM', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
					</div>
					<div class="col-sm-3" style="padding-top: 5px;">
						<img src="/images/info.png" style="width: 24px;" 
							 data-toggle="popover" 
							 title="Okt.&nbsp;int.&nbsp;OM&nbsp;száma" 
							 data-content="Jogosultságot megalapozó középfokú oktatási intézmény 6 jegyű OM száma."
							 data-trigger="hover"
						/>						
					</div>
				</div>
				

				<hr>


				<div class="form-group" style="border-top: 1px solid lightgray; padding-top: 5px;">
					<label for="email" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Email:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('email', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-3 control-label"><span style="color: red; font-weight: bold;">*</span>&nbsp;Telefonszám:</label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('phone', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?><br>
						<div style="font-size: 12px; color: red; margin-top: -15px; margin-bottom: 10px;">
							Kérjük ne felejtse el megadni az előhívószámokat (<b>06</b> vagy <b>+36</b>)
							vagy a külföldi számok esetén a nemzetközi előhívó számot a <b>+</b> jel után. <i>(Pl.:&nbsp;Egyesült&nbsp;Királyság&nbsp;+44, Ausztria:&nbsp;+43)</i>
						</div>
					</div>
				</div>



				<?php //debug($freeinternet); die();
					$cb1 = '';
					$cb2 = '';
					//$cb3 = '';
					//$cb4 = '';
					//$cb5 = '';
					if($freeinternet->cb1){$cb1=' checked';}
					if($freeinternet->cb2){$cb2=' checked';}
					//if($freeinternet->cb3){$cb3=' checked';}
					//if($freeinternet->cb4){$cb4=' checked';}
					//if($freeinternet->cb5){$cb5=' checked';}
				?>

				<div class="form-group">
					<label for="none" class="col-md-3 control-label">&nbsp;</label>
					<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
						<div id="div-cb1" class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding: 5px;">
							<input type="checkbox" id="cb1" name="cb1"<?= $cb1 ?> />
							<label for="cb1"><span style="color: red; font-weight: bold;">*</span>&nbsp;IV. Alulírott  jogosult büntetőjogi felelősségem tudatában nyilatkozom a  szolgáltató felé, hogy az 501/2020. (XI. 14.) Korm. rendelet szerinti ingyenes szolgáltatás igénybevételének feltételei fennállnak és az igénybejelentés valós adatokat tartalmaz..</label>
						</div>
						<div id="div-cb2" class="icheck-turquoise" style="border-bottom: 1px solid lightgray; padding-bottom: 10px; padding: 5px;">
							<input type="checkbox" id="cb2" name="cb2"<?= $cb2 ?> />
							<label for="cb2"><span style="color: red; font-weight: bold;">*</span>&nbsp;Az adatkezelési szabályzatot elfogadom (alábbi zöld gombra kattintva olvasható)</label>
						</div>
<?php /*
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
*/ ?>
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
					<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Kattintson ide az adatlap beküldéséhez',
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
        <h4 class="modal-title" id="gdpeLabel"><?= __('Adatkezelési tájékoztató') ?></h4>
      </div>
      <div class="modal-body">
        <?= $text->text ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Elolvastam</button>
      </div>
    </div>
  </div>
</div>



<?php /*
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










<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>

        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($freeinternet,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Sub Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('sub_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Mother Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('mother_name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">City:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('city', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Address:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Phone:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Email:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Student Card Number:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('student_card_number', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Status:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('status', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Ip:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('ip', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cb1:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cb1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cb2:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cb2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cb3:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cb3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cb4:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cb4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cb5:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cb5', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/freeinternets/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

*/ ?>