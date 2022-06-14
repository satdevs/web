<?php
	//debug($this);
	if(isset($services)){
		foreach($services as $service){
			//debug($service->name);
			//debug($service->toArray());
		}
	}
	//die();
	if(isset($servicegroup)){
		if(!isset($servicegroup)){
			$servicegroup = 0;
		}
	}
?>
<style>
	td, th{
		padding: 15px 10px;
	}
	#result th:first-child, #result td:first-child{
		font-size: 16px;
		padding: 10px 20px 10px 15px;
		text-align: left;
	}
	#result th:nth-child(2), #result td:nth-child(2){
		font-size: 20px;
		padding: 10px 20px 10px 10px;
		text-align: right;
	}
</style>

<?php if(isset($currentCityId) && $currentCityId>0){ ?>
<div id="szolgaltatasok-csomagok">
	<div id="szolgaltatasok" class="col-sm-8 col-sm-pull-4">
		<div class="blog">
			<div class="blog-item">


			
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<!--h2 class="text-center">Internet szolgáltatásunk</h2-->
							<?php if(!isset($currentCityId) || $currentCityId=="" || $currentCityId==Null){ ?>
								<h2 style="margin-top: 20px; margin-bottom: 30px;" class="text-center">Kérem válasszon települést!</h2>
							<?php } /*else{ ?>
								<h2 style="margin-top: 20px; margin-bottom: 30px;" class="text-center"><?= $serviceName ?> <b><?= $currentCity ?></b> településen</h2>
							<?php } */ ?>
					        <div class="box-body">
				   				<?php //= $this->Form->create($cities) ?>
					            <div class="form-group">
					                <div class="col-sm-6 col-md-8 text-right" style="padding-top: 6px; padding-right: 5px;">
										Kérem válasszon települést:
					                </div>
					                <div class="col-sm-6 col-md-4 col-xs-12">
										<?= $this->Form->input('city', ['options'=>$cities, 'default'=>$currentCityId, 'id'=>'selectedCity', 'data-size'=>'15', 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Kérem válasszon települést', 'autofocus'=>false, 'disabled'=>false ]); ?>
					                </div>
					            </div>            
					    		<?php //= $this->Form->end() ?>
				            </div>
						</div>
					</div>
				</div>

				
				

<?php if($this->request->params['pass'][0] == 128 || $this->request->params['pass'][0] == 129 || $this->request->params['pass'][0] == 76): ?>
				<div class="container" style="margin-top: 20px;">
					<div class="row">
						<div class="col-sm-12">
							<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Sajnáljuk!</strong><br>Ezen a településen egyelőre nem tud csomagot egyénileg összeállítani
							</div>	
						</div>	
					</div>	
				</div>	

<?php else: ?>


				<div class="container" style="margin-top: 20px;">
					<h3 style="margin-bottom: 20px;">Válasszon szolgáltatásaink közül:</h3>
					<form>
						<div class="row">
							<div class="col-sm-2 text-right">
								<h4>Kábel TV:</h4>							
							</div>
							<div class="col-sm-5">
								<select id="catv" class="selectpicker" data-width='100%'  data-style="btn-success">
									<option id="100" value="100" prod-id="0" selected>--- Kérem válasszon ---</option>
									<option id="102" value="102" prod-id="2" price="3735" data-subtext="49 digitális cs.">KTV Családi csomag</option>
									<option id="103" value="103" prod-id="3" price="4655" data-subtext="100+35HD digitális cs.">KTV Bővített csomag</option>

									<?php /* <option id="101" value="101" prod-id="1" price="2500" data-subtext="16 analóg csatorna">KTV Mini csomag</option> */ ?>
<?php /*
									<option id="101" value="101" prod-id="1" price="2500" data-subtext="2500&nbsp;Ft">KTV Mini csomag</option>
									<option id="102" value="102" prod-id="2" price="3735" data-subtext="3735&nbsp;Ft">KTV Családi csomag</option>
									<option id="103" value="103" prod-id="3" price="4655" data-subtext="4655&nbsp;Ft">KTV Bővített csomag</option>
*/ ?>
								</select>
							</div>
							<div class="col-sm-5 text-left">
								<p id="catv-details" style="margin-top: 0px;">&nbsp;</p>
							</div>
						</div>
						
						<hr>
							
						<div class="row">
							<div class="col-sm-2 text-right">
								<h4>Internet:</h4>							
							</div>
							<div class="col-sm-5">
								<select id="net" class="selectpicker" data-width='100%' data-style="btn-info">
									<option id="200" value="200" prod-id="0" selected>--- Kérem válasszon ---</option>
<?php /*
									<option id="201" value="201" prod-id="4" price="3361" data-subtext="3361&nbsp;Ft">Internet Mini csomag</option>
									<option id="202" value="202" prod-id="5" price="4200" data-subtext="4200&nbsp;Ft">Internet Midi csomag</option>
									<option id="203" value="203" prod-id="6" price="5039" data-subtext="5039&nbsp;Ft">Internet Maxi csomag</option>
									<option id="204" value="204" prod-id="7" price="7350" data-subtext="7350&nbsp;Ft">Internet Extra csomag</option>
*/ ?>
								</select>
							</div>
							<div class="col-sm-5 text-left">
								<p id="net-details" style="margin-top: 0px;">&nbsp;</p>
							</div>
						</div>
						
						<hr>
						
						<div class="row">
							<div class="col-sm-2 text-right">
								<h4>Telefon:</h4>
							</div>							
							<div class="col-sm-5">
								<select id="tel" class="selectpicker" data-width='100%' data-style="btn-warning">
									<option id="400" value="400" prod-id="0" selected>--- Kérem válasszon ---</option>
								</select>
							</div>
							<div class="col-sm-5 text-left">
								<p id="tel-details" style="margin-top: 0px;">&nbsp;</p>
							</div>
						</div>
						
						<hr>
						
						<div class="row">
							<div class="col-sm-2 text-right">
								<h4>Digitális:</h4>
							</div>							
							<div class="col-sm-5">
								<select id="digi" class="selectpicker" data-width='100%' title="--- Kérem válasszon ---" data-style="btn-primary" multiple>
									<option id="801" pid="25" value="801" price="1080" data-subtext="1080 Ft" prod-id="12">Filmbox csomag</option>
									<option id="802" pid="26" value="802" price="590"  data-subtext="590 Ft"  prod-id="13">Film Now csomag</option>
									<option id="803" pid="32" value="803" price="950"  data-subtext="950 Ft"  prod-id="14">Életrevaló csomag</option>
									<!--option id="804" pid="27" value="804" price="990"  data-subtext="990 Ft"  prod-id="15">Dallam csomag</option-->
									<!--option id="805" pid="28" value="805" price="990"  data-subtext="990 Ft"  prod-id="16">Sport csomag</option-->
									<option id="806" pid="29" value="806" price="980"  data-subtext="980 Ft"  prod-id="17">Kölyök csomag</option>
									<!--option id="807" pid="30" value="807" price="280"  data-subtext="280 Ft (1180 Ft helyett)" prod-id="18">HD-1 csomag</option-->
									<!--option id="809" pid="59" value="809" price="560"  data-subtext="560 Ft" prod-id="20">HD-2 csomag</option-->
									<option id="808" pid="31" value="808" price="880"  data-subtext="880 Ft"  prod-id="19">Csábító csomag</option>
								</select>
							</div>
							<div class="col-sm-5 text-left">
								<p id="digi-details" style="margin-top: 0px;">&nbsp;</p>
							</div>
						</div>
							
						<div class="row">
							<div class="col-sm-12 text-center">
								<p id="digi-comment" style="color: red; margin-top: 0px;">&nbsp;</p>
							</div>
						</div>
						
						<hr>
						
						<div class="row">
							<div class="col-sm-12 text-center">
								<button id="calculate" type="button" class="btn btn-lg btn-success">Kérem az árajánlatot</button>
							</div>
						</div>
					</form>						
				
					<hr>
					
					<div id="row-result" class="row">
						<div class="col-sm-12 text-center">
							<div id="result"></div>
						</div>
					</div>
					
					<div id="row-offer" class="row">
						<div class="col-sm-12 text-center">
							<div id="offer"></div>
						</div>
					</div>
					
					<hr>
					
					<div class="row">
						<div class="col-sm-12">
							<?php //debug($this->request->params); ?>
							<?php //= $this->cell('Texts', ['parameters'=>[$city->headstation_id, $servicegroup]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?php //= $this->cell('Uploads', ['parameters'=>[$servicegroup]] ); //Parameter: servicegroup:1..9 ?>
							<?php //= $this->cell('Texts', ['parameters'=>[$service->headstation_id,1]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?php //= $this->cell('Uploads', ['parameters'=>[1]] ); //Parameter: servicegroup:1..9 ?>
<?php
/*
	if($niceURI=="kabeltv.html" && $product_count1==0){
		echo '<p class="text-center">Sajnáljuk, az adott településen nem érhető el a televízió szolgáltatásunk.</p>';
	}
	*/
?>
						</div>
					</div>
				</div>
				

				<h2 class="text-center" style="margin-top: 40px;">
					<a href="/dokumentumok.html" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> További dokumentumok, dokumentumtár...</a>
				</h2>

				<p class="text-center" style="margin-top: 30px; color: #b33; font-weight: bold;">
					A honlapon megjelenített információk (ideértve a megjelölt díjakat is) kizárólag tájékoztatás céljából kerülnek közzétételre.
					A tájékoztatás nem teljes körű, részletekért érdeklődjön ügyfélszolgálatunkon.
				</p>

<?php endif; ?>


			</div>
			<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
		</div>
	</div>
</div>

<?php } //if(isset($currentCityId) && $currentCityId>0): ?>




<div class="modal fade" id="modal-interest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-interest-title" id="myModalLabel">Érdeklődés a választott szolgáltatásokról</h4>
      </div>
	  <div class="modal-body">
		<!--div class="row" style="background: #efefff; margin-bottom: 15px; padding-top: 10px; padding-bottom: 10px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="modal-interest-services"></div>
			</div>
		</div-->			
		<div class="row">
			<p class="text-center">Kérem adja meg adatait az alábbi űrlapon<br>és mi megkeressük Önt a megadott elérhetőségek egyikén!</p>
			<div class="col-sm-12">
				<div id="modal-interest-form">
					<form class="form-horizontal">
						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">*Neve:</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="name" placeholder="Ön neve (vezeték és keresztnév)" autofocus="autofocus" />
							</div>
						</div>
						<div class="form-group">
							<label for="city" class="col-sm-3 control-label">*Cím:</label>
							<div class="col-sm-3">
							  <input type="text" class="form-control" id="zip" placeholder="Irányítószám vagy helyrajzi szám" value="<?= $city->irsz ?>" readonly disabled />
						</div>
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="city" placeholder="Település neve" value="<?= $city->name ?>" readonly disabled />
						</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-sm-3 control-label">*Utca, hsz.:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="address" placeholder="Utca, házszám, ..." required />
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-3 control-label">*Tel.szám:</label>
							<div class="col-sm-9">
								<input type="tel" class="form-control" id="phone" placeholder="Telefonszám" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">*Email:</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
							</div>
						</div>
					  
				  
						<div class="form-group">
							<label for="captcha" class="col-sm-3 control-label">*Biztonsági kód:</label>
							<div class="col-sm-3">
								<?php echo $this->Form->input('captcha', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Írja ide a kódot', 'autofocus'=>false, 'disabled'=>false, 'minlength'=>3, 'maxlength'=>3, 'required'=>true ]); ?>
							</div>
							<div class="col-sm-6">
								<div style='font-family: "Courier New"; height: 35px; border: 2px solid red; width: 90%; line-height: 3px; padding: 2px; text-align: center; font-size: 5px; letter-spacing: -1px; background: red;'>
									<div id="show-captcha"></div>
								</div>
							</div>
						</div>            
					  
					  
						<div class="form-group">
							<label for="message" class="col-sm-3 control-label">Egyéb kérdés:</label>
							<div class="col-sm-9">
								<textarea class="form-control" id="message" placeholder="Egyéb kérdése van? Itt megírhatja..." style="max-height: 85px;"></textarea>
							</div>
						</div>

						<div class="form-group" style="display: none;">
							<div class="col-sm-9">
								<input id="ids" type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
							</div>
						</div>
					  
					  
					<!--div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox"> Adatkezelési tájékoztatót elolvastam és elfogadom
							</label>
						</div>
					</div>
					</div-->

					</form>
				</div>
			</div>
		</div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Mégsem</button>
        <button type="button" class="btn btn-primary" id="button-send-interest">Érdekel</button>
      </div>
    </div>
  </div>
</div>











<script>
<?php /*
//Event Type 	Description
//show.bs.select 	This event fires immediately when the show instance method is called.
//shown.bs.select 	This event is fired when the dropdown has been made visible to the user (will wait for CSS transitions, to complete).
//hide.bs.select 	This event is fired immediately when the hide instance method has been called.
//hidden.bs.select 	This event is fired when the dropdown has finished being hidden from the user (will wait for CSS transitions, to complete).
//loaded.bs.select 	This event fires after the select has been initialized.
//rendered.bs.select 	This event fires after the render instance has been called.
//refreshed.bs.select 	This event fires after the refresh instance has been called.
//changed.bs.select 	This event fires after the select's value has been changed. It passes through event, clickedIndex, newValue, oldValue.
*/ ?>

$(document).ready( function(){
	
	//---------------------------------- Alapszövegek -----------------------------------
	var catv_text 	= 'Kérem válasszon kábel-TV csomagot.';
	var net_text 	= 'Kérem válasszon Internet csomagot.<br>KTV választása esetén kedvezőbb árakkal.';
	var tel_text 	= 'Telefonszolgáltatást csak KTV és/vagy Internet mellé vehető igénybe.';
	var digi_text 	= 'Digitális csomagjaink csak KTV bővített csomag mellé vehetők igénybe.';
	var digi_text_2 = 'Kérem válasszon digitális csomgjaink közül.';
	var digi_comment_empty = '&nbsp;';
	var digi_comment= 'Havidíj ellenében választható digitális csomagjaink igénybevételéhez digitális kártyaolvasóra úgynevezett CAM modulra van szükség aminek tévénként egyszeri 8200 Ft-os díja van.';
	

	//-- Init --
	$("#catv").val(100);
	$("#catv").selectpicker('refresh');
	$("#net").val(300);	
	$("#net").selectpicker('refresh');
	
	optionsChangeNetList()
	
	//---------------------------------- TEL tömb ---------------------------------------
	//var dependencies[tel_id] = [catv_id][net_id]
	$("#catv-details").html(catv_text);
	$("#net-details").html(net_text);
	$("#tel-details").html(tel_text);
	$("#digi-details").html(digi_text);
	$("#digi-comment").html(digi_comment_empty);
	
	//---------------------------------- TEL tiltása alapból ----------------------------
	$('#tel').prop('disabled', true);
	$('#tel').selectpicker('refresh');
	//---------------------------------- DIGI tiltása alapból ---------------------------
	$("#digi option:selected").prop("selected", false);	//Választott digi tételek törlése
	$('#digi').prop('disabled', true);
	$('#digi').selectpicker('refresh');
	
	$('#result').hide();
	$('#offer').hide();
	
	
	//███████████████████████████████████████████████████ CATV ███████████████████████████████████████████████████
	$('#catv').on('changed.bs.select', function (e) {
		$('#result').hide();
		$('#offer').hide();
		//--------------------- Telefon engedélyezése, tiltása a NET függvényében --------------------------------
		if($("#catv").val()==100 && $("#net").val()==200){
			$("#tel").val(400);
			$("#tel").prop('disabled', true);
			$("#tel-details").html(tel_text);
		}else{
			$("#tel").prop('disabled', false);
		}
		
		//-------------------------------- DIGI engedélyezése, tiltása a CATV Bővített csomag függvényében -------
		if($("#catv").val()==103){
			$('#digi').prop('disabled', false);
			$("#digi-details").html(digi_text_2);	//Kérem válasszon
			showDigiSelecteds();
		}else{
			$('#digi').prop('disabled', true);
			$("#digi-details").html(digi_text);		//Csak KTV Bővített mellé vehető igénybe
			$("#digi-comment").html(digi_comment_empty);	// ""
		}
		
		if($("#catv").val()!=103){
			$("#digi option:selected").prop("selected", false);
		}

		$("#tel").selectpicker('refresh');
		$('#digi').selectpicker('refresh');
		
		optionsChangePhoneList();
		optionsChangeNetList();
		
	});

	//███████████████████████████████████████████████████ NET ████████████████████████████████████████████████████
	$('#net').on('changed.bs.select', function(e) {
		$('#result').hide();
		$('#offer').hide();
		//--------------------- Telefon engedélyezése, tiltása a CATV függvényében -------------------------------
		if($("#catv").val()==100 && $("#net").val()==200){
			$("#tel").val(400);
			$("#tel").prop('disabled', true);
			$("#tel-details").html(tel_text);
		}else{
			$("#tel").prop('disabled', false);
		}
		$("#tel").selectpicker('refresh');
		optionsChangePhoneList();
	});

	
	//███████████████████████████████████████████████████ TEL ████████████████████████████████████████████████████
	$('#tel').on('changed.bs.select', function (e) {
		$('#result').hide();
		$('#offer').hide();


		
	});

	//███████████████████████████████████████████████████ DIGI ███████████████████████████████████████████████████
	$('#digi').on('changed.bs.select', function (e) {
		$('#result').hide();
		$('#offer').hide();
		showDigiSelecteds();

	});

	//============================================================================================================
	function optionsChangePhoneList(){
		var options = [];
		var i=0;
		
		options[i++] = {text: "--- Kérem válasszon ---", value: 400, subtext: ''};
		
		if( ($("#catv").val()>100 && ($("#net").val()==200) || $("#net").val()==300)	//Ha csak TV
			||
			(
				($("#catv").val()==100 && ( $("#net").val()>200) && $("#net").val()<300)		<?php //vagy csak NET ?>
				||
				($("#catv").val()==100 && ( $("#net").val()>300) && $("#net").val()<400)		<?php //vagy csak NET ?>
			)
		){
			options[i++] = {text: "Telefonszolgáltatás", value: 401, subtext: ''};				<?php //Telefon KTV vagy NET mellé 1625&nbsp;Ft ?>
		}else{
			options[i++] = {text: "Telefonszolgáltatás", value: 402, subtext: ''};				<?php //Telefon KTV és NET mellé 815&nbsp;Ft ?>
			//----------------------------------------------------- ??????????????? 303 ???????? -----------------
			
			if( $("#catv").val()==103 &&  ( $("#net").val()==203 || $("#net").val()==303 || $("#net").val()==204 ) ){
				
				options[i++] = {text: "Telefon, havi díjból lebeszélhető 1000 Ft", value: 404, subtext: ''};	<?php //KTV Bővített és Internet Maxi vagy Extra mellé csomagban ?>
			}
			options[i++] = {text: "Telefon, havi díjból lebeszélhető 1200 Ft", value: 403, subtext: ''};		<?php //Telefon KTV vagy NET mellé 1500&nbsp;Ft ?>
		}

		if( ($("#catv").val()>100 ) ){
			options[i++] = {text: "Telefon Csevej Csomag", value: 405, subtext: ''};			<?php //KTV mellé 2690&nbsp;Ft ?>
			options[i++] = {text: "Telefon Extra Csevej Csomag", value: 406, subtext: ''};		<?php //KTV mellé 3390&nbsp;Ft ?>
		}
		
		if(	$("#catv").val()==100 && (($("#net").val()==200) || $("#net").val()==300) ){
			options = [];
			options[0] = {text: "--- Kérem válasszon ---", value: 400, subtext: ''};
			$('#tel').prop('disabled', true);
		}else{
			$('#tel').show();
			$('#tel').prop('disabled', false);
		}
		
		$("#tel").replaceOptions(options);
		$("#tel").selectpicker('refresh');
	}		
	//============================================================================================================

	//============================================================================================================
	function optionsChangeNetList(){
		var options 	= [];
		var value 		= parseInt( $("#net").val() );
		var newvalue 	= 300;

		if( $("#catv").val()==100 ){
			options[0] 	= {text: "--- Kérem válasszon ---", value: 300, subtext: ''};
			options[1] 	= {text: "Internet Mini Csomag KTV nélkül",  value: 301, subtext: '100 Mbit/s'};
			options[2] 	= {text: "Internet Midi Csomag KTV nélkül",  value: 302, subtext: '300 Mbit/s'};
			options[3] 	= {text: "Internet Maxi Csomag KTV nélkül",  value: 303, subtext: '500 Mbit/s'};
			options[4] 	= {text: "Internet Extra Csomag KTV nélkül", value: 304, subtext: '700 Mbit/s'};
			if(value>200 && value<300){
				newvalue = value+100;
			}
			if(value>300 && value<400){
				newvalue = value;
			}
		}
		
		if( $("#catv").val()>100 ){
			options[0] 	= {text: "--- Kérem válasszon ---", value: 200, subtext: ''};
			options[1] 	= {text: "Internet Mini Csomag",  value: 201, subtext: '100 Mbit/s'};
			options[2] 	= {text: "Internet Midi Csomag",  value: 202, subtext: '300 Mbit/s'};
			options[3] 	= {text: "Internet Maxi Csomag",  value: 203, subtext: '500 Mbit/s'};
			options[4] 	= {text: "Internet Extra Csomag", value: 204, subtext: '700 Mbit/s'};
			if(value>300 && value<400){
				newvalue = value-100;
			}
			if(value>200 && value<300){
				newvalue = value;
			}
		}
		
		$("#net").replaceOptions(options);
		$("#net").val(newvalue);
		$("#net").selectpicker('refresh');
		
	}
	//============================================================================================================
	
	

	
	function showDigiSelecteds(){
		var str = "<ul>";
		var selected=0;
		
		$("#digi option:selected").each(function() {
			str += "<li>"+$(this).text()+"</li>";
			selected++;
		});
		str += "</ul>";
		if(selected>0){
			$("#digi-details").html(str);
			$("#digi-comment").html(digi_comment);	// "Csak CAM modul megléte esetén nézhető"
		}else{
			$("#digi-details").html(digi_text_2);
			$("#digi-comment").html(digi_comment_empty);	// "Csak CAM modul megléte esetén nézhető"
		}

	}
	
	
	
	//###############################################################################################
	//###############################################################################################
	//####################################                 ##########################################
	//####################################     SZÁMOLÁS    ##########################################
	//####################################                 ##########################################
	//###############################################################################################
	//###############################################################################################
	$('#calculate').on('click', function(){
		var total 		= 0;
		var catv 		= [];
		var net 		= [];
		var tel 		= [];
		var digi 		= [];
		var pkg 		= [];
		var data1, data2, data3, data4, data8;
		var td 			= ''; 
		var td_sum 		= ''; 
		var td_total	= '';
		var td_sum_digi = '';
		var pack 		= '';
		var sum			= 0;
		var pack_price	= 0;
		var td_digi 	= '';
		var sum_digi	= 0;
		var total		= 0;
		var table 		= '';
		var isPackage	= false;
		//var ul 			= "<ul>";	//Választott digi tételek listázása modal-ba
		var digi_selected=0;		//Ha van választott digi tétel, akkor a fenti tételek kiiratása
		var content_id 	= 0;
		
		var table_start  = '<div style="background: #efe; border: 1px solid green; margin-bottom: 10px;">';
			table_start += '	<h3>Választott szolgáltatások</h3>';
			table_start += '	<div id="content-0" class="text-left" style="padding: 15px;">';
		var content 	 = '';
		var digi_title 	 = '';
		var digi_content = '';
		var table_end 	 = '';
		var digi_ids	= '';
		var digi_list	= '';
		var service_total = '';
		var show_total	= '';
		var ids			= '';
		
		catv[100] = {price:0, 	id:0,  text:''};
		catv[101] = {price:2500,id:1,  text:'KTV Mini csomag'};
		catv[102] = {price:3735,id:2,  text:'KTV Családi csomag (49 csatorna)'};
		catv[103] = {price:4655,id:3,  text:'KTV Bővített csomag (100+35HD csatorna)'};
		
		net[200] = {price:0,	id:0,  text:''};
		net[201] = {price:3361, id:4,  text:'Internet Mini csomag'};
		net[202] = {price:4200, id:5,  text:'Internet Midi csomag'};
		net[203] = {price:5039, id:6,  text:'Internet Maxi csomag'};
		net[204] = {price:7350, id:7,  text:'Internet Extra csomag'};
		
		net[300] = {price:0,	id:0,  text:''};
		net[301] = {price:4874,	id:8,  text:'Internet Mini KTV nélkül csomag'};
		net[302] = {price:5713,	id:9,  text:'Internet Midi KTV nélkül csomag'};
		net[303] = {price:6552,	id:10, text:'Internet Maxi KTV nélkül csomag'};
		net[304] = {price:8102,	id:11, text:'Internet Extra KTV nélkül csomag'};
		
		tel[400] = {price:0,	id:0,  text:''};
		tel[401] = {price:1625,	id:12, text:'Telefonszolgáltatás'};
		tel[402] = {price:815,	id:13, text:'Telefonszolgáltatás'};
		tel[403] = {price:1500,	id:14, text:'Telefon, havi díjból lebeszélhető 1200 Ft'};
		tel[404] = {price:595,	id:57, text:'Telefon, havi díjból lebeszélhető 1000 Ft'};
		tel[405] = {price:2690,	id:15, text:'Telefon Csevej csomag'};
		tel[406] = {price:3390,	id:16, text:'Telefon Extra Csevej csomag'};
		
		pkg[800] ={price:0,	id:0,  text:'Csomagok'};
		pkg[801] ={price:9131,	id:17, text:'Maxi duó'};
		pkg[802] ={price:9727,	id:18, text:'Maxi kombó'};
		pkg[803] ={price:11822,id:19, text:'Maxi trió 1'};
		pkg[804] ={price:12522,id:20, text:'Maxi trió 2'};
		pkg[805] ={price:11400,id:21, text:'Extra duó'};
		pkg[806] ={price:11995,id:22, text:'Extra kombó'};
		pkg[807] ={price:14090,id:23, text:'Extra trió 1'};
		pkg[808] ={price:14790,id:24, text:'Extra trió 2'};
		
		data1 = catv[$('#catv').val()];
		data2 = net[$('#net').val()];
		data4 = tel[$('#tel').val()];
		data8 = pkg[800];	//init
		
		ids = '';
		if(typeof(data1)!='undefined'){
			if(data1.price>0){
				content += '<div style="margin-bottom: 10px; clear: both; width: 100%;"><b>'+data1.text+'</b> <span class="service-price" style="float: right; font-size: 20px;">'+data1.price+'&nbsp;Ft</span></div>';
				sum += data1.price;
				if($('#catv').val()=='101'){ ids = ids + '1,'; }
				if($('#catv').val()=='102'){ ids = ids + '2,'; }
				if($('#catv').val()=='103'){ ids = ids + '3,'; }
			}
		}
			
		if(typeof(data2)!='undefined'){
			if(data2.price>0){
				content += '<div style="margin-bottom: 10px; clear: both; width: 100%;"><b>'+data2.text+'</b> <span class="service-price" style="float: right; font-size: 20px;">'+data2.price+'&nbsp;Ft</span></div>';
				sum += data2.price;
				if($('#net').val()=='201'){ ids = ids + '4,'; }
				if($('#net').val()=='202'){ ids = ids + '5,'; }
				if($('#net').val()=='203'){ ids = ids + '6,'; }
				if($('#net').val()=='204'){ ids = ids + '7,'; }
				if($('#net').val()=='301'){ ids = ids + '8,'; }
				if($('#net').val()=='302'){ ids = ids + '9,'; }
				if($('#net').val()=='303'){ ids = ids + '10,'; }
				if($('#net').val()=='304'){ ids = ids + '11,'; }
			}
		}

		
		if(typeof(data4)!='undefined'){
			if(data4.price>0){
				content += '<div style="margin-bottom: 10px; clear: both; width: 100%;"><b>'+data4.text+'</b> <span class="service-price" style="float: right; font-size: 20px;">';
				if(data4.price>0){
					content += data4.price+'&nbsp;Ft';
				}else{
					content += '--';
				}		
				content += '</span></div>';
				sum += data4.price;
				if($('#tel').val()=='401'){ ids = ids + '12,'; }	//Telefonszolgáltatás			1625
				if($('#tel').val()=='402'){ ids = ids + '13,'; }	//Telefonszolgáltatás           815
				if($('#tel').val()=='403'){ ids = ids + '14,'; }	//Telefon lebeszélhető 1200 Ft  1500
				if($('#tel').val()=='404'){ ids = ids + '57,'; }	//Telefon lebeszélhető 1000 Ft  595
				if($('#tel').val()=='405'){ ids = ids + '15,'; }	//Telefon Csevej csomag         2690
				if($('#tel').val()=='406'){ ids = ids + '16,'; }	//Telefon Extra Csevej csomag   3390
			}
		}
		
		//content += '<div id="service-total" style="font-weight: normal; text-align: right; font-size: 20px; margin-top: 10px; margin-bottom: 20px; clear: both; width: 100%;"><span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+sum+'&nbsp;Ft</span></div>';
		content += '<div id="service-total" style="font-weight: normal; text-align: right; font-size: 20px; margin-top: 10px; margin-bottom: 20px; clear: both; width: 100%;"><span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">&nbsp;</span></div>';

		
		$("#digi option:selected").each(function() {
			digi_content += '&nbsp;•&nbsp;'+$(this).text()+'&nbsp;-&nbsp;'+$(this).attr('price')+'&nbsp;Ft<br>';
			sum_digi += parseInt($(this).attr('price'));
			digi_list += $(this).text()+', '
			digi_ids +=  $(this).attr('pid')+','
		});
		digi_list 	= '<i>('+digi_list.substr(0, digi_list.length-2)+')</i>'; //AJAX-szal lesz elküldve
		digi_ids 	= digi_ids.substr(0, digi_ids.length-1);
		total = sum + sum_digi;
		
		if(sum_digi>0){
			digi_title = '<div style="clear: both; width: 100%; "><b>Választott digitális csomag(ok)</b><span style="float: right; font-size: 20px;">'+sum_digi+'&nbsp;Ft</span></div>';
			digi_content = digi_title + digi_content;
		}
		
		content += digi_content;
		
		//---------- Csomagok számítása ----------		
		if( $('#catv').val()==103 && $('#net').val()==203 && ($('#tel').val()==400 || typeof($('#tel').val())=='undefined' ) ){
			data8 = pkg[801];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Maxi duó</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Maxi duó</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '17,';
		}
		if( $('#catv').val()==103 && $('#net').val()==203 && $('#tel').val()==404 ){
			data8 = pkg[802];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Maxi kombó</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Maxi kombó</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</span></td></tr>';
			ids = '18,';
		}
		if( $('#catv').val()==103 && $('#net').val()==203 && $('#tel').val()==405 ){
			data8 = pkg[803];
			isPackage = true;
			pack_price = data8.price;			
			total = pack_price + sum_digi;
			service_total = '<b>Maxi trió 1</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Maxi trió 1</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '19,';
		}
		if( $('#catv').val()==103 && $('#net').val()==203 && $('#tel').val()==406 ){
			data8 = pkg[804];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Maxi trió 2</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Maxi trió 2</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '20,';
		}
		
		if( $('#catv').val()==103 && $('#net').val()==204 && ($('#tel').val()==400 || typeof($('#tel').val())=='undefined' ) ){
			data8 = pkg[805];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Extra duó</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Extra duó</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '21,';
		}
		if( $('#catv').val()==103 && $('#net').val()==204 && $('#tel').val()==404 ){
			data8 = pkg[806];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Extra kombó</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Extra kombó</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '22,';
		}
		if( $('#catv').val()==103 && $('#net').val()==204 && $('#tel').val()==405 ){
			data8 = pkg[807];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Extra trió 1</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td style="text-align: right; color: red;"><b>Extra trió 1</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '23,';
		}
		if( $('#catv').val()==103 && $('#net').val()==204 && $('#tel').val()==406 ){
			data8 = pkg[808];
			isPackage = true;
			pack_price = data8.price;
			total = pack_price + sum_digi;
			service_total = '<b>Extra trió 2</b> csomagként <span style="float: right; border-top: 1px solid gray; font-size: 20px; font-weight: bold; padding-left: 15px;">'+pack_price+'&nbsp;Ft</span>';
			pack += '<tr><td class="text-right" style="color: red;"><b>Extra trió 2</b> csomagként</td><td><span style="font-weight: bold; color: red;">'+pack_price+'</span>&nbsp;Ft</td></tr>';
			ids = '24,';
		}

		show_total = '<div style="padding: 10px 0; text-align: right; font-size: 18px; width: 100%; clear: both;">Összesen:&nbsp;<span style=" font-size: 20px; font-weight: bold; border-top: 1px solid black;">'+total+'&nbsp;Ft</span></div>';
		
		ids 	= ids.substr(0, ids.length-1);
		if(digi_ids.length > 0){
			ids = ids + ',' + digi_ids;
		}
		
		if(total>0){
			$('#result').hide();
			$('#offer').hide();
			table = table_start+content
			if(isPackage){
				//table += pack;
			}else{
				table += td_sum;
			}
			if(sum_digi>0){
				table += td_digi+td_sum_digi
			}
			
			table_end 	 = '	</div>';
			table_end	+= '	<div style="text-align: center; width: 100%; clear: both; border-bottom: 0px solid lightblue; padding: 10px 10px 15px;">';
			table_end	+= '		<button ids="'+ids+'" class="btn btn-primary interest" content-id="content-0" type="submit">Érdekel</button>';
			table_end	+= '	</div>';
			table_end	+= '</div>';
			
			table += td_total+show_total+table_end
			$('#result').html(table);
			$('#result').fadeIn(2000);
			
			if(service_total!=''){
				$('#service-total').html(service_total);
				$('.service-price').html('<span style="font-size: 14px; font-style: italic;">(csomag ár)</span>');
			}
			
			//AJAX-szal lekérni a további ajánlatokat
			data = {'catv':data1.id, 'net':data2.id, 'tel':data4.id, 'pkg':data8.id, 'total':total, 'sum':sum, 'packprice':pack_price, 'sumdigi':sum_digi, 'digilist':digi_list, 'digiids':digi_ids }
			
			$("#offer").hide();
			
			if(ids==''){
				alert('Hibás parancsvégrehajtás. Hiányzó azonosítók. Kérem frissítse az oldalt és próbálja újra.');
				return false;
			}
			
			$.ajax({
				type: "POST", 
				cache: false,
				url: "/getOffers", 
				//url: '<?= $this->Url->build(['plugin' => null, 'controller' => 'Controllers', 'action' => 'action']) ?>'
				dataType: 'json',	// Most vettem ki. Tesztelni!!!
				data: JSON.stringify(data),
				success: function(result){
					$('#offer').html(result.table).promise().done(function(){						
						$("#offer").fadeIn(2000);
						//$('.interest').click( function(){							
						$('.interest').on('click', function(){
							$('#ids').val( $(this).attr('ids') );
							content_id = $(this).attr('content-id');
							$("#modal-interest-services").html( $("#"+content_id).html() ).promise().done(function(){								
								getNewCaptcha();								
								$("#modal-interest").modal('show');
							});
						});
					});
				}
			});
			
			$('html, body').animate({	<?php //Ha megvan a számítás, akkor odagörget ?>
				scrollTop: $('#row-result').offset().top-100
			}, 500);		
			
		}else{
			alert('Kérem válasszon szolgáltatást!');
		}		

		if(isPackage){
			$(".price").html('<span style="font-size: 12px; font-weight: normal; font-style: italic;">(csomag árban)</span>');
		}
		
	//});	//Calculate

//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
//##########################################################################################################################################################
		$('#button-send-interest').on('click', function(){
			var digi = '';
			var error = 0;
			var catv = $('#catv').val();
			var net = $('#net').val();
			var tel = $('#tel').val();
			//var pkg = $('#pkg').val();

			if($('#ids').val()==''){
				alert('Hibás parancsvégrehajtás. Kérem frissítse az oldalt és próbálja újra elküldeni.');
				return false;
			}

			if($('#captcha').val() == ''){
				$('#captcha').css('border','1px solid red');
				//$('#captcha').trigger('focus');			
				setTimeout(function (){
					$('#captcha').focus();
				}, 1000);			
				error = 1;
			}else{
				$('#captcha').css('border','1px solid gray');
			}

			if($('#email').val() == ''){
				$('#email').css('border','1px solid red');
				error = 1;
				//$('#email').trigger('focus');
				setTimeout(function (){
					$('#email').focus();
				}, 1000);
			}else{
				$('#email').css('border','1px solid gray');
			}
			
			if($('#phone').val() == ''){
				$('#phone').css('border','1px solid red');
				error = 1;
				//$('#phone').trigger('focus');
				setTimeout(function (){
					$('#phone').focus();
				}, 1000);
			}else{
				$('#phone').css('border','1px solid gray');
			}

			if($('#address').val() == ''){
				$('#address').css('border','1px solid red');
				error = 1;
				//$('#address').trigger('focus');
				setTimeout(function (){
					$('#address').focus();
				}, 1000);
			}else{
				$('#address').css('border','1px solid gray');
			}
			
			if($('#city').val() == ''){
				$('#city').css('border','1px solid red');
				error = 1;
				//$('#city').trigger('focus');
				setTimeout(function (){
					$('#city').focus();
				}, 1000);
			}else{
				$('#city').css('border','1px solid gray');
			}
			
			if($('#zip').val() == ''){
				$('#zip').css('border','1px solid red');
				error = 1;
				//$('#zip').trigger('focus');
				setTimeout(function (){
					$('#zip').focus();
				}, 1000);
			}else{
				$('#zip').css('border','1px solid gray');
			}
			
			if($('#name').val() == ''){
				$('#name').css('border','1px solid red');
				error = 1;
				//$('#name').trigger('focus');
				setTimeout(function (){
					$('#name').focus();
				}, 1000);
			}else{
				$('#name').css('border','1px solid gray');
			}
			
			$("#digi option:selected").each(function() {
				digi += $(this).attr('prod-id')+',';
			});
			digi = digi.substr(0, digi.length-1 );
			
			data = {
				'services':	$('#modal-interest-services').html(),
				'name':		$('#name').val(),
				'zip':		$('#zip').val(),
				'city':		$('#city').val(),
				'address':	$('#address').val(),
				'phone':	$('#phone').val(),
				'email':	$('#email').val(),
				'message':	$('#message').val(),
				'captcha':	$('#captcha').val(),
				'ids':		$('#ids').val()
			}

			if(error == 0){

				$.ajax({
					type: "POST", 
					cache: false,
					url: "/sendOffer", 
					dataType: 'json',	// Most vettem ki. Tesztelni!!!
					data: JSON.stringify(data),
					success: function(result){
						if(result.ok){
							alert('Üzenetét sikeresen elküldtük. Hamarosan felkeressük Önt a megadott elérhetőségek egyikén!');
							//$("#captcha").val('');
							$("#modal-interest").modal('hide');
						}else{
							if(result.message != ''){
								alert(result.message);
							}else{
								alert('Hiba a feldolgozásban! Kérem, nézze át az megadott adatokat és próbálja újra elküldeni! [#1]');
							}
							$('#captcha').val('');
							getNewCaptcha();
						}
					}
				});

			}else{
				alert('Kérem adja meg a hányzó, csillaggal jelölt adatokat!');
			}			
		});
		
	});	//Calculate
	
	function getNewCaptcha(){
		$.ajax({
			type: "POST", 
			cache: false,
			url: "/getNewCaptcha", 
			success: function(result){
				$("#show-captcha").html(result);
			}
		});
		$('#captcha').val('');	
	}


	$('#modal-interest').on('show.bs.modal', function (e) {
		//$('#name').focus();
	});	
	
	$('#modal-interest').on('shown.bs.modal', function () {
		//$('#name').focus();
		$('#name').trigger('focus');
	})	
	
	
});

(function($, window) {
  $.fn.replaceOptions = function(options) {
    var self, $option;
	
    this.empty();
    self = this;

    $.each(options, function(index, option) {
      $option = $("<option></option>")
        .attr("data-subtext", option.subtext)
        .attr("value", option.value)
        .text(option.text);
      self.append($option);
    });
  };
})(jQuery, window);

</script>


