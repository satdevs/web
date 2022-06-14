<style>
	td, th{
		padding: 15px 10px;
	}
</style>
<div id="szolgaltatasok-csomagok">
	<!--div id="contact" class="col-sm-8 col-sm-pull-4"-->
	<div id="szolgaltatasok" class="col-sm-8 col-sm-pull-4">
		<div class="blog">
			<div class="blog-item">

<?php if(isset($currentCityId) && $currentCityId>0): ?>
			
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
					                <div class="col-sm-6 col-md-4 col-xs-12" style="">
										<?= $this->Form->input('city', ['options'=>$cities, 'default'=>$currentCityId, 'id'=>'selectedCity', 'data-size'=>'15', 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Kérem válasszon települést', 'autofocus'=>false, 'disabled'=>false ]); ?>
					                </div>
					            </div>
					    		<?php //= $this->Form->end() ?>
				            </div>
						</div>
					</div>
				</div>


<?php //EGYEDI CSOMAGÖSSZEÁLLÍTÁS gomb megjelenítése - if(!FIVAN, !Homorúd és !Újmohács ?>
<?php /* if(false && !($currentCityId==76 || $currentCityId==128 || $currentCityId==129)): */ ?>
<?php if(!($currentCityId==76 || $currentCityId==128 || $currentCityId==129)): ?>
							<h2 style="width: 100%; margin-top: 15px; margin-bottom: 20px;" class="text-center" style="margin-top: 0px;">
								<!--a style="width: 100%; font-size: 18px;" href="/csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a-->
								<a style="width: 100%; font-size: 18px;" href="/egyedi-csomag/<?= $currentCityId ?>/egyedi-csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a>
							</h2>		
<?php endif; ?>

<?php //if(isset($newproducts) && !empty($newproducts->toArray())){ ?>

				<div class="container" style="margin-top: 20px;">
					<div class="row">
						<div class="col-sm-12">
<?php
							if(!isset($servicegroup)){
								$servicegroup = 0;
							}
?>
<?php if(isset($newproducts) && !empty($newproducts->toArray())){ ?>
							<h2 class="text-center"><?php
							switch($servicegroup){
								case 1: 
									echo "Műsorelosztás díjai";
									break;
								case 2: 
									echo "Internet szolgáltatás díjai";
									break;
								case 4: 
									echo "Telefonszolgáltatás díjai";
									break;
								case 8: 
									echo "Csomagok díjai";
									break;
							}
							?></h2>
<?php }else{ // if(!empty($newproducts->toArray())){ ?>
							<div class="box-body">
							
								<div class="alert alert-warning alert-dismissible" style="border: 2px dotted #dcc;">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-info"></i> Sajnáljuk!</h4>
									Nincs <b>
<?php
									switch($servicegroup){
										case 1: 
											echo "műsortovábbítás (televízió)";
											break;
										case 2: 
											echo "Internet";
											break;
										case 4: 
											echo "Telefon";
											break;
										case 8: 
											echo "csomagok";
											break;
									}
?>									</b>
									szolgáltatásunk <b><?= $city->name ?></b> településen.
								</div>
							</div>
<?php } // if(!empty($newproducts->toArray())){ ?>
							

<?php if(isset($newproducts) && !empty($newproducts->toArray())){ ?>
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center" class="table table-responsive">
								<tr>
									<th class="text-left" style="text-align: left;">Termék neve/Tartalma</th>
									<th style="width: 15%;">Ár</th>
								</tr>

								
<?php
foreach ($newproducts as $newproduct):
	if($newproduct->servicegroup < 9){
?> 
								<tr>
									<td>
<?php if($newproduct->servicegroup==1){ ?>
										<a href="#" class="channel" product-id="<?= h($newproduct->id) ?>"><b><?= h($newproduct->name) ?></b></a>
<?php }else{ ?>
										<b><?= h($newproduct->name) ?></b>
<?php } ?>
										
										<?php
											if($newproduct->content != ''){
												echo "<br>";
												echo nl2br($newproduct->content);												
											}											
										?>
									</td>
									<td style="text-align: center; padding: 3px;"><span class="price">
										<?= $this->Number->format($newproduct->price,[
												'places' => 0,
												'locale' => 'hu_HU',
												'after' => '&nbsp;Ft',
												'escape' => FALSE,
												//'pattern' => '0 000 000'
											]) ?><br>
										</span>
									</td>
								</tr>
<?php
	}
endforeach;
?>
							</table>


<?php
//########################################################################################################################################
//########################################################################################################################################
//########################################################################################################################################
?>

							
<?php
if($servicegroup == 1 && $currentCityId!=128 && $currentCityId!=129):
?>
							<h4 class="text-center" style="margin-top: 40px;">Havidíj ellenében választható digitális csomagok</h4>

							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center" class="table table-responsive">
								<tr>
									<th class="text-left" style="text-align: left;">Termék neve/Tartalma</th>
									<th style="width: 15%;">Ár</th>
								</tr>

								
<?php
foreach ($newproducts as $newproduct):
	if($newproduct->servicegroup == 9){
?> 
								<tr>
									<td>
										<b><?= h($newproduct->name) ?></b><?php
											if($newproduct->content != ''){
												echo "<br>";
												echo nl2br($newproduct->content);												
											}											
										?>
									</td>
									<td style="text-align: center; padding: 3px;"><span class="price">
										<?= $this->Number->format($newproduct->price,[
												'places' => 0,
												'locale' => 'hu_HU',
												'after' => '&nbsp;Ft',
												'escape' => FALSE,
												//'pattern' => '0 000 000'
											]) ?><br>
										</span>
									</td>
								</tr>
<?php
	}
endforeach;
?>
							</table>
<?php endif; ?>

<?php } // if(!empty($newproducts->toArray())){ ?>

							
							<?= $this->cell('Texts', ['parameters'=>[$city->headstation_id, $servicegroup]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
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
				
<?php else: //if(isset($currentCityId) && $currentCityId>0): ?>

	<!--h3 class="text-center">Ön hibás web címre kattintott vagy adott meg!</h3>
	<p class="text-center">Kérem válasszon a fenti menüpontok közül!</p-->

<?php endif; //if(isset($currentCityId) && $currentCityId>0): ?>
				
				
<?php /* }else{ //if(isset($newproducts) && !empty($newproducts->toArray())){ ?>
		<h2 align="center">Sajnáljuk!<br>A választott településen nincs elérhető szolgáltatásunk!</h2>
		<h3 align="center" style="color: red;">Kérjük, válasszon másik települést!</h3>
<?php }	*/	 //if(isset($newproducts) && !empty($newproducts->toArray())) ?>
			
<?php /*
				<h2 class="text-center" style="margin-top: 40px;">
					<a href="/dokumentumok.html" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> További dokumentumok, dokumentumtár...</a>
				</h2>
*/ ?>
				<p class="text-center" style="margin-top: 30px; color: #b33; font-weight: bold;">
					A honlapon megjelenített információk (ideértve a megjelölt díjakat is) kizárólag tájékoztatás céljából kerülnek közzétételre.
					A tájékoztatás nem teljes körű, részletekért érdeklődjön ügyfélszolgálatunkon.
				</p>
			
			
			
			</div>
			<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
		</div>
	</div>
</div>



<?php /*
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" id="modalChannels" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myLargeModalLabel"><span id="modalPackageTitle">&nbsp;</span></h4>
      </div>
      <div class="modal-body">
		
        <div id="modalChannelsList"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready( function(){

	$(".channel").click( function(){
		var windowWidth = $(window).width();
		var documentWidth = document.body.clientWidth;
		var id = $(this).attr("product-id");
		
		$("#modalPackageTitle").html( "<b>" + $(this).text()+'</b> <i>(analóg)</i> tartalma <b><?= $city->name ?></b> településen' );
		$("#modalChannels").modal('show');
		
		if(documentWidth >= 1000){
			$('#modalChannels').find('.modal-dialog').outerWidth('800px');
		}else{
			$('#modalChannels').find('.modal-dialog').outerWidth('90%');
		}
		
		data = {'id': id}
		//console.log( id );
		$.ajax({
			type: "POST", 
			cache: false,
			url: "/getChannels", 
			//url: '<?= $this->Url->build(['plugin' => null, 'controller' => 'Controllers', 'action' => 'action']) ?>'
			//dataType: 'json',
			data: JSON.stringify(data),
			success: function(result){
				//console.log( result );
				$("#modalChannelsList").html( result );
				
				//$('#offer').html(result.table).promise().done(function(){
				//	$("#offer").fadeIn(2000);
				//	$('.interest').click( function(){
				//		content_id = $(this).attr('content-id');
				//		$("#modal-interest-services").html( $("#"+content_id).html() ).promise().done(function(){
				//			$("#modal-interest").modal('show');
				//		});
				//	});
				//});
			}
		});

		
		
	});

	$('#modalChannels').on('hidden.bs.modal', function (e) {
		$("#modalChannelsList").html('');
	});
	






		// //var modalDialogWidth = $('#modalChannels').find('.modal-dialog').outerWidth(true);
        // //console.log ('modalDialogWidth = ' + modalDialogWidth);		
        // //console.log ('windowWidth = ' + windowWidth);		
        // //console.log ('documentWidth = ' + documentWidth);		

		//$("#modalChannels").width('1000px');
		
		
	
});
</script>

*/ ?>
