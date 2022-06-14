<?php
	//debug($this->request->params['pass'][0]); die();
	//debug($this->request->cookies);

	//if(isset($this->request->cookies['currentCityId'])){
	//	$currentCityId = $this->request->cookies['currentCityId'];
	//}else{
	//	$currentCityId = 0;
	//}
	
	//debug($this->request->session()->read()); die();
	
	//debug($_COOKIE['currentCityId']);
	//die();
	
	///if(isset($_COOKIE['currentCityId'])){	//$this->request->cookies['currentCityId'])){
	///	//$currentCityId = $this->request->cookies['currentCityId'];
	///	$currentCityId = $_COOKIE['currentCityId'];
	///	//$this->request->session()->read('currentCityId');
	///}else{
	///	$currentCityId = 0;
	///}
	
	//$currentCityId = $_COOKIE['currentCityId'];
	if($this->request->session()->read('currentCityId')){
		$currentCityId = $this->request->session()->read('currentCityId');
	}else{
		$currentCityId = 0;
	}
	//$this->request->cookies['currentCityId'];
	//debug($currentCityId);
	//die();
	
?>
<!--
------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
-->
<?php if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]=='home'){?>

	<?php /* <div id="size" style="text-align: center;"></div> */ ?>

	<section id="services" style="padding: 10px;">
		<div class="container">
			<div class="row" style="padding-left: 15px; padding-right: 15px;">
			
				<div id="service-cover">
				
					<a href="/GINOP-2.1.8-17-2017-01681.html" target="_blank" class="col-xs-12 hidden-sm hidden-md hidden-lg text-right">
						<div id="md-ginop" class="col-xs-12 hidden-sm hidden-md hidden-lg">
							<img id="img-ginop" class="img-responsive" src="/images/szechenyi-2018.jpg">
						</div>
					</a>
				
					<a href="/akciok.html">
						<div id="md-campaign" class="col-md-2 col-sm-2 col-xs-6 text-center md" style="border: 0px solid red;">
							<img src="/images/icon_campaign.png" alt="" class="responsive" style="height: 80px;"><br>
							<h3>Akciók</h3>
						</div>
					</a>
				
					<a href="/csomagok/<?= $currentCityId ?>/kabeltv.html">
						<div id="md-catv" class="col-md-2 col-sm-2 col-xs-6 text-center md" style="">
							<i class="fa fa-television" style="font-size: 75px; color: #1496d5; height: 80px;"></i><br>
							<h3>Kábel TV</h3>
						</div>
					</a>
					
					<a href="/csomagok/<?= $currentCityId ?>/internet.html">
						<div id="md-internet" class="col-md-2 col-sm-2 col-xs-6 text-center md" style="">
							<img src="/images/icon_internet.png" alt="" class="responsive" style="height: 80px;"><br>
							<h3>Internet</h3>
						</div>
					</a>
					
					<a href="/csomagok/<?= $currentCityId ?>/telefon.html">
						<div id="md-phone" class="col-md-2 col-sm-2 col-xs-6 text-center md" style="">
							<i class="fa fa-phone" style="font-size: 75px; color: #1496d5; height: 80px;"></i><br>
							<h3>Telefon</h3>
						</div>
					</a>
					
					<a href="/GINOP-2.1.8-17-2017-01681.html" target="_blank" class="hidden-xs">
						<div id="md-ginop" class="col-md-4 col-sm-4 col-xs-6 hidden-xs text-right">
							<img id="img-ginop" class="img-responsive" src="/images/szechenyi-2018.jpg">
						</div>
					</a>
<?php /*				
*/ ?>

				</div>
				
			</div>
		</div>
	</section>
<?php } ?>
<!--
------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
-->
<?php /*
<script>
$(window).ready( function(){
	
	$("#size").text( $( document ).width() );
	
	$(window).resize( function(){
		$("#size").text( $( window ).width() );
	});
	
});
</script>
*/ ?>
