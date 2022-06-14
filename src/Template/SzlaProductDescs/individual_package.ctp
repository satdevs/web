<?php
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
				<h2 style="margin-top: 30px; margin-bottom: 10px;" class="text-center">Állítsa össze saját szolgáltatás csomagját</h2>
				<div class="container" style="margin-top: 0px;">
					<h4 class="text-center">Válasszon az alábbi szolgáltatások közül</h4>

<?php $group = 1; ?>
<?php
	if(in_array($group, $show)){	//Az 1-es benne van a megjeleníthető csoportokban... a $show már fentebb ki lett gyűjtve, hogy mik vannak---
?>
					<h4 class="text-center" style="margin-top: 24px; margin-bottom: 0px; border-bottom: 1px solid lightgray; padding-bottom: 6px;">1. Kábel TV</h4>
<?php
		$product_count1 = 0;
		//debug($services);
		foreach ($services as $service):
			if($service->szla_product->csoport==$group){
				$product_count1++;
?>
					<div class="row" style="margin-top: 6px;">
						<div>
							<div class="col-lg-5 col-md-5 col-sm-12 text-center" style="padding-top: 6px; padding-top: 5px;">
								<div id="<?= $service->id ?>" class="switches"><input id="input-<?= $service->id ?>" type="radio" name="group-<?= $group ?>" data-label-width="150px" data-on-text="Igen" data-off-text="Nem" data-label-text="<?= $service->name ?>" data-radio-all-off="true" class="switch-<?= $group ?>"></div>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-left hidden-xs hidden-sm">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-center hidden-md hidden-lg">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>
						</div>
					</div>
<?php 
			}
		endforeach;
	}
?>
<?php if( isset($headstation_id) && $headstation_id == 1 ):	//-- BÓLY fejállomásnál jelenik meg ez a ██████ FIGYELMEZTETŐ ██████ szekció ?>
					<div style="margin-top: 0px; min-height: 40px; margin-bottom: 0px; padding-bottom: 0px;" class="row">
						<div style="padding-left: 46px; padding-right: 10px; margin-bottom: 0px; " class="col-lg-12">
							<p style="display: block; margin-bottom: 0px;" id="message_in_CATV" class="text-center">
							<span style="color: red; font-weight: bold;">Figyelem!</span><br>
							Havidíj ellenében nézhető digitális csomagjaink választása esetén <b>KTV Bővített</b> előfizetése szükséges.</p>
						</div>					
					</div>
<?php endif; ?>

<?php $group = 2; ?>
<?php
	if(in_array($group, $show)){
?>
					<h4 class="text-center" style="margin-top: 24px; margin-bottom: 0px; border-bottom: 1px solid lightgray; padding-bottom: 6px;">2. Internet</h4>
<?php
		$product_count2 = 0;
		foreach ($services as $service):
			if($service->szla_product->csoport==$group){
				$product_count2++;
?>
					<div class="row" style="margin-top: 6px;">
						<div>
							<div class="col-lg-5 col-md-5 col-sm-12 text-center" style="padding-top: 6px; padding-top: 5px;">
								<div id="<?= $service->id ?>" class="switches"><input id="input-<?= $service->id ?>" type="radio" name="group-<?= $group ?>" data-label-width="150px" data-on-text="Igen" data-off-text="Nem" data-label-text="<?= $service->name ?>" data-radio-all-off="true" class="switch-<?= $group ?>"></div>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-left hidden-xs hidden-sm">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-center hidden-md hidden-lg">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>							
						</div>
					</div>
<?php 
			}
		endforeach;
	}
?>



<?php $group = 4; ?>
<?php
	if(in_array($group, $show)){
?>
					<h4 class="text-center" style="margin-top: 24px; margin-bottom: 0px;">3. Telefon</h4>
					<p class="text-center" style="border-bottom: 1px solid lightgray; padding-bottom: 6px;">Figyelem! A különböző telefon szolgáltatásaink a KTV és Internet szolgáltatások választásának függvényében érhetőek el.</p>
<?php
		$product_count4 = 0;
		//debug($services);
		foreach ($services as $service):
			if($service->szla_product->csoport==$group){
				$product_count4++;
?>
					<div class="row" style="margin-top: 6px;">
						<div>
							<div class="col-lg-5 col-md-5 col-sm-12 text-center" style="padding-top: 6px; padding-top: 5px;">
								<div id="<?= $service->id ?>" class="switches"><input id="input-<?= $service->id ?>" type="radio" name="group-<?= $group ?>" data-label-width="150px" data-on-text="Igen" data-off-text="Nem" data-label-text="<?= $service->name ?>" data-radio-all-off="true" class="switch-<?= $group ?>"></div>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-left hidden-xs hidden-sm">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>
							<div class="col-lg-7 col-md-7 col-sm-12 text-center hidden-md hidden-lg">
								<b><?= $service->name ?></b><br>
								<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
								<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
							</div>							
						</div>
					</div>
<?php 
			}
		endforeach;
	}
?>



<?php $group = 9; ?>
<?php
	if(in_array($group, $show)){
?>
					<div id="digital-packages">
						<h4 class="text-center" style="margin-top: 24px; margin-bottom: 0px; border-bottom: 0px solid lightgray; padding-bottom: 6px;">4. Havidíj ellenében választható digitális TV csomagjaink</h4>
<?php if( isset($headstation_id) && $headstation_id == 1 ):	//-- FIVAN fejállomásnál jelenik meg ez a szekció ?>
						<div class="row" style="margin-top: 6px;" id="">
							<div class="col-lg-12" style="padding-left: 20px; padding-right: 20px;">
								<p class="text-center">Havidíj ellenében nézhető digitális csomagjaink választása esetén <b>KTV Bővített</b> előfizetése szükséges.</p>
							</div>					
						</div>
<?php endif; ?>
<?php if( isset($headstation_id) && $headstation_id == 2 ):	//-- FIVAN fejállomásnál jelenik meg ez a szekció ?>
						<div class="row" style="margin-top: 6px;" id="">
							<div class="col-lg-12" style="padding-left: 20px; padding-right: 20px;">
								<p class="text-center">Az alábbi csomagjaink előfizetéséhez KTV bővített előfizetése szükséges vagy<br>
								a KTV Mini választása mellé mellé, kérjük válasszon telefon vagy Internet szolgáltatást is.</p>
							</div>					
						</div>
<?php endif; ?>
						<div style="border-bottom: 1px solid lightgray;"></div>
<?php
		$product_count9 = 0;
		//debug($services);
		foreach ($services as $service):
			if($service->szla_product->csoport==$group){
				$product_count9++;
?>
						<div class="row" style="margin-top: 6px;">
							<div>
							<div class="col-lg-5 col-md-5 col-sm-12 text-center" style="padding-top: 6px; padding-top: 5px;">
									<div id="<?= $service->id ?>" class="switches"><input id="input-<?= $service->id ?>" type="checkbox" name="digi-<?= $service->id ?>" data-label-width="150px" data-on-text="Igen" data-off-text="Nem" data-label-text="<?= $service->name ?>" data-radio-all-off="true" class="switch-<?= $group ?>"></div>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-12 text-left hidden-xs hidden-sm">
									<b><?= $service->name ?></b><br>
									<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
									<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
								</div>
								<div class="col-lg-7 col-md-7 col-sm-12 text-center hidden-md hidden-lg">
									<b><?= $service->name ?></b><br>
									<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
									<?php if($service->description!=""){echo "<p>".$service->description."</p>\n"; } ?>
								</div>		

								<!--div class="col-lg-7">
									<b><?= $service->name ?></b><br>
									<?php if($service->contents!=""){echo "<p>".$service->contents."</p>\n"; } ?>
									<?php if($service->description!=""){echo $service->description."\n"; } ?>
								</div-->
							</div>
						</div>
<?php 
		}
	endforeach;
	}
?>
					</div>

					<div class="container" style="margin-top: 30px;">
						<div class="row">
							<div class="col-lg-12 text-center">								
								<button id="getPackageBid" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;Ár kalkuláció</button>
							</div>
						</div>
					</div>


<!--
	------------------------------------------------------------------------------------------------------------------------------------
-->
					<div id="services-show" class="container">
						<!-- Választott csomagok és ár kiírása -->
						<div id="products-show" class="row">
							<div class="col-lg-12" style="border-bottom: 0px solid lightgray;">
								<h2 class="text-center" style="margin-top: 5px;">Választott szolgáltatásaink árai</h2>
								<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
									&nbsp;  <!--h4 class="text-left"><b>Megnevezés</b></h4-->
								</div>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
									<h4 class="text-center"><b>Havidíj</b></h4>
								</div>							
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
								<div class="text-left">
									<h4 id="products-title"></h4>
									<ul id="products-list"></ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
								<div class="text-right">
									<h4 style="margin-top: 18px;"><span id="products-price">-</span> Ft</h4>
								</div>
							</div>							
						</div>

						<!-- Választott digitális csomagok és ár kiírása -->
						<div id="digitals-show" class="row">
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
								<div class="text-left">
									<h4>Választott havidíjas digitális TV csomagjaink:</h4>
									<ul id="digitals-list"></ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
								<div class="text-right">
									<h4><span id="digitals-price">-</span> Ft</h4>
								</div>
							</div>							
						</div>

						<!-- Fizetendő kiírása -->
						<div id="total-show" class="row" style="padding-bottom: 0px;">
							<div class="col-lg-12">


								<div class="row">
									<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 text-right" style="padding-top: 6px;">
										<h4>Összesen:</h4>
									</div>							
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
										<div class="text-right">
											<h4><b><span id="total-price">-</span>&nbsp;Ft</b></h4>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
										<span id="mainInterestButton"></span>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12 text-center" style="padding-top: 15px; margin-bottom: 0px; font-size: 16px;">
										<p>
											Az "Érdekel" gombra történő kattintás nem jelent közvetlenül megrendelést, csak megrendelési szándékot feltételez.
											Az adatok megadása után felvesszük Önnel a kapcsolatot és személyesen egyeztetünk a megrendeléssel kapcsolatban.
										</p>
									</div>							
								</div>
							</div>
						</div>

					</div>
<!--
	------------------------------------------------------------------------------------------------------------------------------------
-->

					<!-- További ajánlatok -->
					<div id="offers" class="container">
						<div class="row" style="border: 0px solid lightgray; padding-bottom: 0px; margin-top: 30px;">
							<h2 class="text-center" style="margin-top: 5px; margin-bottom: 5px; color: green;"><span class="glyphicon glyphicon-arrow-down"></span>&nbsp;&nbsp;&nbsp;További ajánlatok&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-down"></span></h2>
							<div class="col-lg-12" style="margin-bottom: 0px;">
								<p id="messageIfSelectedDigitalPackages" class="text-center"><span style="color: red; font-weight: bold;">Figyelem!</span><br>Az alábbi ajánlatokhoz hozzáadódik még választott, havidíj ellenében nézhető digitálsi csomagok ára.</p>

								<div class="row" style="background: #fff; padding-top: 20px; border-bottom: 1px solid lightgray;">
									<div class="col-lg-7 col-md-5 col-sm-8 col-xs-8 text-left"  style="padding-left: 40px;">
										<h4>Szolgáltatások megnevezése</h4>
									</div>
									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 text-center" style="border-left: 0px solid lightgray;">
										<h4>Havi díj</h4>
									</div>
									<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 text-center" style="border-left: 0px solid lightgray;">
										&nbsp;
									</div>
								</div>
								<div id="html-offers"></div>
							</div>
						</div>

					</div>



<!--
	------------------------------------------------------------------------------------------------------------------------------------
-->

					<div class="row" style="margin-top: 80px;"> <!-- Csomag tartalma -->
						<div class="col-lg-12">
							<?php
								if( isset($headstation_id) && $headstation_id>0 ){
									echo $this->cell('Texts', ['parameters'=>[ $headstation_id, 108 ]] ); //Parameters: headstation: 1..5, 108 -> Egyedi csomagösszeállítás
								}
							?>
							<?= $this->cell('Uploads', ['parameters'=>[3]] ); //Parameter: servicegroup:1..7 ?>
							<h2 class="text-center" style="margin-top: 40px;">
								<a href="/dokumentumok.html" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> Dokumentumtár</a>
							</h2>
						</div>
					</div>

			</div><!-- blog-item -->

		</div>
		<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
	</div>
</div>




<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- /.CSOMAG ------------------------------------------------ -->
<!-- ############################################################################################################ -->



