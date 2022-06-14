<?php
	$product_count1=0;	//KábelTV 		//Ha ez a változó nulla, akkor kiírja, hogy Sajnáljuk az adott településen nem érhető el a kiválasztott szolgáltatás
	$product_count2=0; 	//Internet  	//Ha ez a változó nulla, akkor kiírja, hogy Sajnáljuk az adott településen nem érhető el a kiválasztott szolgáltatás
	$product_count4=0;	//Telefon
	$product_count8=0;	//Akció (Csomagok)
	$product_count9=0;	//Akció (Csomagok)
	$serviceName = "";
	if(isset($this->request->params['pass'][1])){
		switch($this->request->params['pass'][1]){
			case 'csomagok.html':
				$serviceName = 'Elérhető csomagok'; 
				break;

			case 'kabeltv.html':
				$serviceName = 'Kábel TV szolgáltatásunk';
				break;

			case 'internet.html':
				$serviceName = 'Internet szolgáltatásunk';
				break;

			case 'telefon.html':
				$serviceName = 'Telefon szolgáltatásunk ';
				break;
		}
	}
?>

<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- SZOLGÁLTATÁSOK ------------------------------------------ -->
<!-- ############################################################################################################ -->
<?php /*
################################################################################################################################################
################################################################################################################################################
######################################################### SELECT - CITY ########################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>
<div id="szolgaltatasok-csomagok">
	<div id="contact" class="col-sm-8 col-sm-pull-4">
		<div class="blog">

			<div class="blog-item">

				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							
							<!--h2 class="text-center">Internet szolgáltatásunk</h2-->
							<?php if(!isset($serviceName) || $serviceName==""){ ?>
								<h2 style="margin-top: 20px; margin-bottom: 30px;" class="text-center">Kérem válasszon települést!</h2>
							<?php }else{ ?>
								<!--h2 style="margin-top: 20px; margin-bottom: 30px;" class="text-center"><?= $serviceName ?> <b><?= $currentCity ?></b> településen</h2-->
							<?php } ?>

					        <div class="box-body">
				   				<?= $this->Form->create($szlaProductDesc) ?>
					            <div class="form-group">
					                <div class="col-sm-6 col-md-8 text-right" style="padding-top: 6px;">
										Kérem válasszon települést:
					                </div>

					                <div class="col-sm-6 col-md-4 col-xs-12">
										<?= $this->Form->input('city', ['id'=>'selectedCity', 'default'=>$currentCityId, 'selected'=>'Babarc', 'data-size'=>'15', 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Kérem válasszon települést', 'autofocus'=>false, 'disabled'=>false ]); ?>
					                </div>
					            </div>            

					    		<?= $this->Form->end() ?>
				            </div>
						</div>
					</div>
				</div>


				<div class="container" style="margin-top: 20px;">
					<div class="row">
						<div class="col-sm-12">
<?php



	$show = [];		//DISTINCT ROW a megjeneníthető szolgáltatásokra, azaz minden értéket csak egyszer ír be a tömbbe...
	foreach ($services as $service) {
		if(isset($service->szla_product->csoport) && !in_array($service->szla_product->csoport, $show)){
			$show[] = $service->szla_product->csoport;			//1 Kábel TV, 2 Internet, 4 Telefon, 8 Akció (Csomagok), 9 Digitális
		}
	}






?>
<?php /*
################################################################################################################################################
################################################################################################################################################
#########################################################    1.KTV     #########################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>
<?php $group = 1; ?>
<?php if($niceURI=="kabeltv.html" && in_array($group, $show)){ ?>
							<h2 class="text-center">Műsorelosztás díja</h2>
							<h2 style="width: 100%; margin-top: 15px; margin-bottom: 20px;" class="text-center" style="margin-top: 0px;">
								<a style="width: 100%; font-size: 18px;" href="/csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a>
							</h2>		
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
								<tr>
									<th style="">Termék neve/Tartalma</th>
									<!--th style="">Az alábbi csomagokban elérhető el<span class="discount-price"></span></th-->
									<th style="width: 15%;">Ár</th>
								</tr>

<?php
	foreach ($services as $service): 

		if($service->szla_product->csoport==$group){
			$product_count1++;

?>
								<tr>
									<td style="text-align: left;  padding: 3px;">
										<b><?= $service->name ?></b><br>
										<?php if($service->contents != ""){ echo $service->contents; } ?>
										<?php if($service->description != ""){ echo $service->description; } ?>
									</td>
									<!--td style="text-align: left;  padding: 3px; padding-top: 12px;">
<?php if(isset($packages[$service->product_id])){ ?>
										<ul>
<?php foreach($packages[$service->product_id] as $package): ?>
											<li><?= $package['DescName'] ?></li>
<?php endforeach; ?>
										</ul>
<?php } ?>
									</td-->									
									<td style="text-align: center; padding: 3px;"><span class="price"><?=
										$this->Number->format($price[$service->product_id][0]['AkcFt1'],[
											'places' => 0,
										    'locale' => 'hu_HU',
										    'after' => '&nbsp;Ft',
										    'escape' => FALSE,
										    //'pattern' => '0 000 000'
										])
										?></span>
									</td>									
								</tr>
<?php 
		}
	endforeach;
?>
							</table>



<?php /* ███████████████████████████████████ DIGITÁLIS CSOMAGJAINK  ████████████████████████████████ */ ?>

<br>
<?php $group=9 ?>
<?php if($niceURI=="kabeltv.html" && in_array($group, $show)){ ?>
							<h3 class="text-center">Havi előfizetési díj ellenében nézhető digitális csomagjaink</h3>
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
								<tr>
									<th style="">Termék neve/Tartalma</th>
									<th style="width: 15%;">Ár</th>
								</tr>

<?php
	foreach ($services as $service): 

		if($service->szla_product->csoport==$group){
			$product_count9++;

?>
								<tr>
									<td style="text-align: left;  padding: 3px;">
										<b><?= $service->name ?></b><br>
										<?php if($service->contents != ""){ echo $service->contents; } ?>
										<?php if($service->description != ""){ echo $service->description; } ?>
										<?php 
											//echo "<br><pre>";
											//print_r($service);
											//echo "</pre>";
										?>								
									</td>
									<td style="text-align: center; padding: 3px;"><span class="price"><?php
										if(isset($digiprice[$service->product_id][0]['AkcFt1'])){
											echo $this->Number->format($digiprice[$service->product_id][0]['AkcFt1']+$digiprice[$service->product_id][0]['LicencPrice'],[
												'places' => 0,
												'locale' => 'hu_HU',
												'after' => '&nbsp;Ft',
												'escape' => FALSE,
												//'pattern' => '0 000 000'
											]);
										} /*else{
											echo $this->Number->format($service->szal_product->ft][
											
											echo $this->Number->format($digiprice[$service->product_id][0]['AkcFt1']+$digiprice[$service->product_id][0]['LicencPrice'],[
												'places' => 0,
												'locale' => 'hu_HU',
												'after' => '&nbsp;Ft',
												'escape' => FALSE,
												//'pattern' => '0 000 000'
											]);
											
										} */
										?></span>
									</td>									
								</tr>
<?php 
		}
	endforeach;
?>
							</table>
<?php } ?>



							
							<?= $this->cell('Texts', ['parameters'=>[$service->headstation_id,1]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?= $this->cell('Uploads', ['parameters'=>[1]] ); //Parameter: servicegroup:1..9 ?>

<?php } //endif in array() ?>
<?php
	if($niceURI=="kabeltv.html" && $product_count1==0){
		echo '<p class="text-center">Sajnáljuk, az adott településen nem érhető el a televízió szolgáltatásunk.</p>';
	}
?>






















<?php /*
################################################################################################################################################
################################################################################################################################################
########################################################   2. INTERNET KTV-vel  ################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>
<?php $group = 2; ?>
<?php if($niceURI=="internet.html" && in_array($group, $show)){ ?>
							<h2 class="text-center">Internet szolgáltatásaink</h2>
							<h2 style="width: 100%; margin-top: 15px; margin-bottom: 20px;" class="text-center" style="margin-top: 0px;">
								<a style="width: 100%; font-size: 18px;" href="/csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a>
							</h2>		
							<!--p  class="text-center">Internetszolgáltatás díjai, <span style="text-decoration: underline; font-weight: bold;">televízió szolgáltatás mellé</span></p-->
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
								<tr>
									<th style="">Termék neve/Tartalma</th>
									<!--th style="">Az alábbi csomagokban elérhető el <span class="discount-price"></span></th-->
									<th style="width: 15%;">Ár</th>
								</tr>
<?php
	foreach ($services as $service): 
		if($service->szla_product->csoport==$group){
			$product_count2++;
?>
								<tr>
									<td style="text-align: left;  padding: 3px;">
										<b><?= $service->name ?></b><br>
										<?php if($service->contents != ""){ echo $service->contents; } ?>
										<?php if($service->description != ""){ echo $service->description; } ?>
									</td>
									<!--td style="text-align: left;  padding: 3px; padding-top: 12px;">
<?php if(isset($packages[$service->product_id])){ ?>
										<ul>
<?php foreach($packages[$service->product_id] as $package): ?>
											<li><?= $package['DescName'] ?></li>
<?php endforeach; ?>
										</ul>
<?php } ?>
									</td-->
									<td style="text-align: center; padding: 3px;"><span class="price"><?=
										$this->Number->format($price[$service->product_id][0]['AkcFt1'],[
											'places' => 0,
										    'locale' => 'hu_HU',
										    'after' => '&nbsp;Ft',
										    'escape' => FALSE,
										    //'pattern' => '0 000 000'
										])
										?></span>
									</td>									
								</tr>

<?php 
		}
	endforeach;
?>
							</table>
							<?= $this->cell('Texts', ['parameters'=>[$service->headstation_id, $group]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?= $this->cell('Uploads', ['parameters'=>[$group]] ); //Parameter: servicegroup:1..7 ?>
<?php } //endif in array() ?>
<?php
	if($niceURI=="internet.html" && $product_count2==0){
		echo '<p class="text-center">Sajnáljuk, az adott településen nem érhető el az Internet szolgáltatásunk.</p>';
	}
?>
























<?php /*
################################################################################################################################################
################################################################################################################################################
#######################################################   4. TELEFON   #########################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>
<?php $group = 4; ?>
<?php
if(isset($packages)):
	$price = [];
	foreach ($packages as $package) {	//Árak elhelyezése a $price tömbben
		foreach ($package as $row) {
			if(isset($row['DescGroup']) && $row['DescGroup']==4){

				if( $row['ProdFt'] != Null ){							//Ha van Termék ár, akkor az az ára
					$price[ $row['DescProdId'] ] = $row['ProdFt'];
				}
				if( $row['AkcFt2'] != Null ){							//Ha van Duo kedvezményes ára, akkor az az ára
					$price[ $row['DescProdId'] ] = $row['AkcFt2'];
				}
				if( $row['AkcFt3'] != Null ){							//ha van TRIO kedvezményes ára, akkor az az ára
					$price[ $row['DescProdId'] ] = $row['AkcFt3'];
				}
			}
		}
	}
?>
<?php if($niceURI=="telefon.html" && in_array($group, $show)){ ?>
							<h2 class="text-center">Telefon szolgáltatásaink</h2>
							<h2 style="width: 100%; margin-top: 15px; margin-bottom: 20px;" class="text-center" style="margin-top: 0px;">
								<a style="width: 100%; font-size: 18px;" href="/csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a>
							</h2>		
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
								<tr>
									<th style="">Megnevezés/Tartalma</th>
									<!--th style="">Az alábbi csomagokban elérhető el <span class="discount-price"></span>:</th-->
									<th style="width: 15%;">Ár</th>
								</tr>
<?php

	foreach ($services as $service): 

		if($service->szla_product->csoport==$group){
			$product_count4++;

?>
								<tr>
									<td style="text-align: left;  padding: 3px;">
										<b><?= $service->name ?></b><br>
										<?php if($service->contents != ""){ echo $service->contents; } ?>
										<?php if($service->description != ""){ echo $service->description; } ?>
									</td>
									<!--td style="text-align: left;  padding: 3px; padding-top: 12px;">
<?php if(isset($packages[$service->product_id])){ ?>
										<ul>
<?php foreach($packages[$service->product_id] as $package): ?>
											<li><?= $package['DescName'] ?></li>
<?php endforeach; ?>
										</ul>
<?php } ?>
									</td-->
									<td style="text-align: center; padding: 3px;"><span class="price"><?=
										$this->Number->format($price[ $service->product_id ],[
											'places' => 0,
										    'locale' => 'hu_HU',
										    'after' => '&nbsp;Ft',
										    'escape' => FALSE,
										    //'pattern' => '0 000 000'
										])
										?></span>
									</td>									
								</tr>
<?php 
		}
	endforeach;
?>
							</table>
							<?= $this->cell('Texts', ['parameters'=>[$service->headstation_id, $group]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?= $this->cell('Uploads', ['parameters'=>[$group]] ); //Parameter: servicegroup:1..7 ?>

<?php } //endif in array() ?>
<?php
	if($niceURI=="telefon.html" && $product_count4==0){
		echo '<p class="text-center">Sajnáljuk, az adott településen nem érhető el szolgáltatásunk.</p>';
	}
endif;
?>




















<?php /*
################################################################################################################################################
################################################################################################################################################
#################################################### 8. CSOMAGOK        ########################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>
<?php $group = 8; ?>
<?php if($niceURI=="csomagok.html" && in_array($group, $show)){ ?>
							<h2 style="margin-top: 15px;" class="text-center">Csomagjaink</h2>
							<h2 style="width: 100%; margin-top: 15px; margin-bottom: 20px;" class="text-center" style="margin-top: 0px;">
								<a style="width: 100%; font-size: 18px;" href="/csomag-osszeallitas.html" type="button" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Állítsa össze saját csomagját </a>
							</h2>		
							<table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
								<tr>
									<th style="width: 30%;">Csomag neve</th>
									<th style="">Tartalma</th>
									<th style="width: 15%;">Ár</th>
								</tr>
<?php
	//---- A termékek számának meghatározásához, hogy az akciós táblából hányadik oszloppal számoljon ---
	foreach ($services as $service):
		if($service->szla_product->csoport==$group){
			$i = 0; $c = 0;
			$detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] = 0;
			foreach ($packages[$service->szla_product->id] as $package) {
				if( $packages[$service->szla_product->id][$i]['AkcFoCikk'] == $package['AkcFoCikk'] ){
					$c++;
				}
			}
			$detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] = $c;
			$i++;
			//debug($service->name);
		}
	endforeach;
	foreach ($detail_count as $key => $value) {
		if($value > 3){
			$detail_count[$key] = 3;
		}
	}
		//--------- E helyett van a fenti részlet ------------
		//if(isset($detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ]) && $detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] > 3){
		//	$detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] = 3;
		//}

	//---- /.A termékek számának meghatározásához, hogy az akciós táblából hányadik oszloppal számoljon ---

	//---- A termékek ÁRának meghatározása ---
	$total = [];
	foreach ($services as $service):
		$i = 0;
		if($service->szla_product->csoport==$group){
			$total[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] = 0;
			foreach ($packages[$service->szla_product->id] as $package) {
				if( $packages[$service->szla_product->id][$i]['AkcFoCikk'] == $package['AkcFoCikk'] ){
					$total[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ] += $package['AkcFt'.$detail_count[ $packages[$service->szla_product->id][$i]['AkcFoCikk'] ]];
				}
			}
			$i++;
		}
	endforeach;
	//---- /.A termékek ÁRának meghatározása ---

	//---- /A NAGY ciklus, a kiiratás ---
	foreach ($services as $service):

		if($service->szla_product->csoport==$group){
			$product_count8++;

?>
								<tr>
									<td style="text-align: center; padding: 3px;"><b><?= $service->name ?></b></td>
									<td style="text-align: left;  padding: 3px;">
										<?php //if($service->contents!=""){echo "<b>".$service->contents."</b><br>"; } ?>
										<?php //= $service->description ?>
										<ul>
<?php
											foreach ($packages[$service->szla_product->id] as $package) {
												if( $packages[$service->szla_product->id][$i]['AkcFoCikk'] == $package['AkcFoCikk'] ){
													echo "<li><b>".$package['DescName']."</b><br>";
													echo $package['DescContent'];
													echo "</li>";
												}
											}
?>										
										</ul>
									</td>
									<td style="text-align: center; padding: 3px;">
										<?=
											$this->Number->format($total[$service->product_id],[
												'places' => 0,
											    'locale' => 'hu_HU',
											    'after' => '&nbsp;Ft',
											    'escape' => FALSE,
											    //'pattern' => '0 000 000'
											]);
										?>
									</td>
								</tr>

<?php 
		}
	endforeach;
?>
							</table>
							<?= $this->cell('Texts', ['parameters'=>[$service->headstation_id, $group]] ); //Parameters: headstation: 1..5, servicegroup:1..7 ?>
							<?= $this->cell('Uploads', ['parameters'=>[$group]] ); //Parameter: servicegroup:1..7 ?>
<?php } //endif in array() ?>
<?php
	if($niceURI=="csomagok.html" && $product_count8==0){	//4. és a 7. a csomagok sekcióban jelenik meg...
		//Ne írjon ki semmit, ha nincs semmi
		echo '<p class="text-center" style="clear: both;">Sajnáljuk, az adott településen nem érhetőek el csomagjaink.</p>';
	}
?>


















<?php /*
################################################################################################################################################
################################################################################################################################################
######################################################       E.N.D.     ########################################################################
################################################################################################################################################
################################################################################################################################################
*/ ?>

							<h2 class="text-center" style="margin-top: 40px;">
								<a href="/dokumentumok.html" type="button" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> További dokumentumok, dokumentumtár...</a>
							</h2>

<p class="text-center" style="margin-top: 30px;">A honlapon megjelenített információk (ideértve a megjelölt díjakat is) kizárólag tájékoztatás céljából kerülnek közzétételre.
A tájékoztatás nem teljes körű, részletekért érdeklődjön ügyfélszolgálatunkon.</p>

						</div>
					</div>
				</div>



			</div><!-- blog-item -->
			<img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />
		</div>
	</div>
</div>
<!-- ############################################################################################################ -->
<!-- -------------------------------------------------- /.SZOLGÁLTATÁSOK ---------------------------------------- -->
<!-- ############################################################################################################ -->

