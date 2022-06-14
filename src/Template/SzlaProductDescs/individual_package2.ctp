<?php 	//--- https://bootsnipp.com/snippets/featured/funky-radio-buttons ---//
	
	$show = [];		//DISTINCT ROW a megjeneníthető szolgáltatásokra, azaz minden értéket csak egyszer ír be a tömbbe...
	foreach ($services as $service) {
		if(isset($service->szla_product->csoport) && !in_array($service->szla_product->csoport, $show)){
			$show[] = $service->szla_product->csoport;			//1 Kábel TV, 2 Internet, 4 Telefon, 8 Akció (Csomagok), 9 Digitális
		}
	}
?>
<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- CSOMAG -------------------------------------------------- -->
<!-- ############################################################################################################ -->
<div id="package-content">
	<div id="contact" class="col-sm-8 col-sm-pull-4">
		<div class="blog">

			<div class="blog-item">



				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<!--h2 class="text-center">Internet szolgáltatásunk</h2-->
							<?php /* if(!isset($serviceName) || $serviceName==""){ ?>
								<h3 style="margin-top: 20px; margin-bottom: 30px;" class="text-center">1. Kérem válasszon települést!</h3>
							<?php }else{ ?>
								<!--h2 style="margin-top: 20px; margin-bottom: 30px;" class="text-center"><?= $serviceName ?> <b><?= $currentCity ?></b> településen</h2-->
							<?php } */ ?>

					        <div class="box-body">
				   				<?= $this->Form->create($szlaProductDesc) ?>
					            <div class="form-group" id="selectCityInIndividualPackage">
					                <div class="col-sm-6 col-md-8 col-xs-12 text-right" style="padding-top: 6px;">
										Kérem válasszon települést:
					                </div>

					                <div class="col-sm-6 col-md-4 col-xs-12">
										<?= $this->Form->input('city', ['id'=>'city_id', 'default'=>$currentCityId, 'label'=>false, 'data-size'=>'15', 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Kérem válasszon települést', 'autofocus'=>false, 'disabled'=>false ]); ?>
					                </div>
					            </div>            

					    		<?= $this->Form->end() ?>
				            </div>
						</div>
					</div>
				</div>



				<!--h2 class="text-center">Internet szolgáltatásunk</h2-->
				<h2 style="margin-top: 30px; margin-bottom: 10px;" class="text-center">Állítsa össze saját szolgáltatás csomagját (2)</h2>
				<div class="container" style="margin-top: 0px;">
					<h4 class="text-center">Válasszon az alábbi szolgáltatások közül</h4>
					
					


					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<hr />
								<h4>Kábel TV csomagok</h4>
								<div class="form-group">
									<div class="funkyradio">
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="ktv1" />
											<label for="ktv1">KTV Mini alap csomag</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="ktv2" />
											<label for="ktv2">Családi csomag</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="ktv3" />
											<label for="ktv3">KTV Bővített csomag</label>
										</div>								
									</div>
								</div>								
							</div>

							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<hr />
								<h4>Internet csomagok</h4>
								<div class="form-group">
									<div class="funkyradio">
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="net1" />
											<label for="net1">Internet Mini</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="net2" />
											<label for="net2">Internet Midi</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="net3" />
											<label for="net3">Internet Maxi</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="net4" />
											<label for="net4">Internet Extra</label>
										</div>								
									</div>
								</div>
							</div>
	
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<hr />
								<h4>Telefon csomagok</h4>
								<div class="form-group">
									<div class="funkyradio">
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel1" />
											<label for="tel1">Telefon szolgáltatás</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel2" />
											<label for="tel2">Telefon Csevely</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel3" />
											<label for="tel3">Telefon Extra Csevely</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel4" />
											<label for="tel4">Lebeszélhető 1000 Ft</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel5" />
											<label for="tel5">Lebeszélhető 1200 Ft</label>
										</div>								
									</div>
								</div>
							</div>
							
							
	
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<hr />
								<h4>Telefon csomagok</h4>
								<div class="form-group">
									<div class="funkyradio">
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel1" />
											<label for="tel1">Telefon szolgáltatás</label>
	
											<input type="checkbox" name="checkbox" id="tel2" />
											<label for="tel2">Telefon Csevely</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel3" />
											<label for="tel3">Telefon Extra Csevely</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel4" />
											<label for="tel4">Lebeszélhető 1000 Ft</label>
										</div>								
										<div class="funkyradio-success">
											<input type="checkbox" name="checkbox" id="tel5" />
											<label for="tel5">Lebeszélhető 1200 Ft</label>
										</div>								
									</div>
								</div>
							</div>
							
								
							

						</div>
					</div>
					
					<hr>

					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								Választott csomagok:<br>

								
								
								
							</div>
						</div>
					</div>
					
					
					
				
				</div>
			</div>
		</div>
		<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
	</div>
</div>

<script>
	$(document).ready( function(){
		$('#fancy-checkbox-tel1').
		
	});

</script>



<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- /.CSOMAG ------------------------------------------------ -->
<!-- ############################################################################################################ -->



