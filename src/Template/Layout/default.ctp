<?php
	$currentCityId = 1;
	if(!isset($simplePayMaintenance)){
		$simplePayMaintenance = false;
	}
	/*
	if(isset($this->request->cookies['currentCityId']) && $this->request->cookies['currentCityId']>0){
		$currentCityId = $this->request->cookies['currentCityId'];
		$_COOKIE['currentCityId'] = $currentCityId;
	}else{
		$_COOKIE['currentCityId'] = 0;
	}
	*/
	//debug($this->request->session()->read('currentCityId')); die();
	//echo $this->request->session()->read('currentCityId');

	if($this->request->session()->read('currentCityId')){
		$currentCityId = $this->request->session()->read('currentCityId');
	}else{
		$currentCityId = 'x';
	}

	if(!isset($title)){ $title="Hiányzó cím!"; }
	$this->assign('title', $title);
	if(!isset($admin)){$admin=false;}
?><!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sághy-Sat Kft. | <?= strip_tags($this->fetch('title')) ?></title>
	<meta name="description" 	content="Sághy-Sat Kft. | <?= strip_tags($this->fetch('title')) ?>" />
	<meta name="author" content="Sághy-Sat Kft." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php if(isset($_SERVER["REQUEST_SCHEME"])){?>
	<meta property="og:title" 		content="Sághy-Sat Kft. | <?= strip_tags($this->fetch('title')) ?>" />
	<meta property="og:type" 		content="website" />
	<meta property="og:url" 		content="<?php echo $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].$this->request->here; ?>" />
	<meta property="og:description"	content="Sághy-Sat Kft. a térség Kábel TV, Internet és Telefon szolgáltatója" />
<?php } ?>
<?php /*
	<meta property="og:image" 		content="<?= $_SERVER['REQUEST_SCHEME'] ?>://<?= $_SERVER['HTTP_HOST'] ?>/images/logo_4.png" />
	<meta property="og:image" 		content="<?= $_SERVER['REQUEST_SCHEME'] ?>://<?= $_SERVER['HTTP_HOST'] ?>/images/facebook.jpg" />
*/ ?>

<?php /*

	<meta property="fb:app_id" 		content="cZLfFhBYDsBuEJ2W20LyjghD6-Y">
	<meta property="og:type" 		content="saghysat-test:catv">
	<meta property="og:url" 		content="http://teszt.saghysat.hu">

	<meta property="og:image" 		content="http://blockbike.hu/images/og_image.jpg">

	<meta property="og:type" 		content="website">

	<meta property="fb:app_id" 		content="1754749721427906">
	<meta property="fb:admins" 		content="100006721751672">
	<meta property="og:description" content="Block Bike Motorszervíz, Mohács">
	<meta property="og:site_name" 	content="blockbike.hu">
	<meta property="og:url" 		content="http://blockbike.hu/items/index/hu/38">
	<meta property="og:locale" 		content="hu_HU">
	<link rel="canonical" href="http://blockbike.hu/items/index/hu/38">

	<meta name="dc.language" 		content="HU">
	<meta name="dc.source" 			content="http://blockbike.hu">
	<meta name="dc.relation" 		content="http://blockbike.hu/">
	<meta name="dc.title" 			content="Block Bike | Block Bike Motorszervíz">
	<meta name="dc.keywords" 		content="Block,Bike,Motorszervíz,Mohács">
	<meta name="dc.subject" 		content="Block Bike Motorszervíz, Mohács">
	<meta name="dc.description"		content="Block Bike Motorszervíz, Mohács">
*/ ?>
	<link href='https://fonts.googleapis.com/css?family=Oswald&subset=latin-ext' rel='stylesheet' type='text/css'>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<!--link href="/css/prettyPhoto.css" rel="stylesheet" -->
	<!--link href="/css/animate.css" rel="stylesheet" -->
	<link href="/css/bootstrap-select.min.css" rel="stylesheet"><!-- Bootstrap SELECT -->
<?php if($this->request->params['action']=="individualPackage") { 	//Ha egyéni csomag összeállítás van	?>
	<link href="/css/bootstrap-switch.min.css" rel="stylesheet"><!-- Bootstrap SWITCH.MIN -->
<?php } ?>
	<link href="/css/main.css" rel="stylesheet">
	<link href="/css/main-saghysat.css" rel="stylesheet">

	<!--link href="/plugins/icheck-1.x/skins/line/blue.css" rel="stylesheet"-->

<?php if(($this->request->params['controller']=='Newproducts' && $this->request->params['action']=='individual')
		  ||
		 ($this->request->params['controller']=='Simplepays' && $this->request->params['action']=='pay')
){ ?>
	<link rel="stylesheet" href="/plugins/iCheck/line/blue.css"><!-- iCheck for checkboxes and radio inputs -->
<?php } ?>

<?php if( ($this->request->params['controller']=='Simplepays' && $this->request->params['action']=='back') ){ ?>
	<link rel="stylesheet" href="/plugins/jQueryCountdown/timeTo.css" type="text/css"/>
<?php } ?>


<?php if(($this->request->params['controller']=='Messages' || $this->request->params['controller']=='Pdfinvoices')
		||
		($this->request->params['controller']=='Simplepays' && $this->request->params['action']=='pay')
		||
		($this->request->params['controller']=='Freeinternets' && $this->request->params['action']=='info')
		||
		($this->request->params['controller']=='Freeinternets' && $this->request->params['action']=='edit')
		||
		($this->request->params['controller']=='Internetextras' && $this->request->params['action']=='add')
		){ ?>
	<link rel="stylesheet" href="/plugins/icheck-bootstrap-master/icheck-bootstrap.min.css" />
<?php } ?>

	<!--[if lt IE 9]>
	<script src="/js/html5shiv.js"></script>
	<script src="/js/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">

	<script src="/js/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
<?php if(
			$this->request->params['controller']=='Pdfinvoices'
		|| ($this->request->params['controller']=='Simplepays')
		|| ($this->request->params['controller']=='Internetextras')
		|| ($this->request->params['controller']=='Freeinternets'))
	  { ?>
	<script src="/plugins/icheck-1.x/icheck.min.js"></script>
<?php } ?>
</head><!--/head-->
<body>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-6721367-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-6721367-2');
	</script>

	<?php
		//debug($cities->toArray());
		//debug($this->request->params['controller']); die();
	?>
	<?php //debug( $this->request ); die(); ?>
	<?php
		//echo $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"];
	 	//phpinfo();
	?>
	<?php /*
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1265416176824794',
	      xfbml      : true,
	      version    : 'v2.7'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/hu_HU/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));

	</script>
	*/ ?>

	<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="hidden-lg hidden-md hidden-sm visible-xs" style="padding: 5px; height: 40px;">
					<img class="img-responsive" src="/images/logo_4.png" alt="Sághy-Sat Kft. - Logo" style="height: 40px;" />
				</div>

				<!-- LG mérethez -->
				<a href="/" class="navbar-brand hidden-xs hidden-sm" style="padding: 5px; padding-bottom: 5px;">
					<div id="logo-flash">
					</div>
				</a>
				<!-- MD méretekhez -->
				<a href="/" class="navbar-brand hidden-lg hidden-md hidden-sm" style="padding: 0px; padding-top: 3px; padding-bottom: 2px;">
				</a>
				<!-- SD méretekhez -->
				<a href="/" class="navbar-brand hidden-lg hidden-md hidden-xs" style="padding: 0px; padding-bottom: 5px; padding-top: 0px;">
					<img id="logo-flash-sm" src="/images/logo.png" alt="Sághy-Sat Kft.">
				</a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right" style="">
<!--
---------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------  M E N Ü        ----------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------
-->
<?php

	//debug($this->request->params);	die();

	$active = "";
	if(isset($this->request->params['pass'][1])){
		switch($this->request->params['pass'][1]){
			case 'akciok.html':
				$active = 'akciok';
				break;
			case 'csomagok.html':
			case 'egyedi-csomag-osszeallitas.html':
				$active = 'csomagok';
				break;
			case 'kabeltv.html':
				$active = 'kabeltv';
				break;
			case 'internet.html':
				$active = 'internet';
				break;
			case 'telefon.html':
				$active = 'telefon';
				break;
		}

	}else{
		//'_matchedRoute' => '/akciok.html',

		if(isset($this->request->here)){
			if($this->request->here=='/'){ $active = 'home'; }
			if($this->request->here=='/mobil.html'){ $active = 'mobil'; }

			if($this->request->params['controller']=='Texts' && $this->request->params['action']=='view' && $this->request->params['pass'][0]==1020){
				$active = 'rtlmost';
			}

			if($this->request->here=='/hirek.html'
				||
				($this->request->params['controller']=='Posts' && $this->request->params['action']=='view')
			){
				$active = 'hirek'; }
				//debug($this->request); die();

			if($this->request->here=='/kapcsolat.html'){ $active = 'kapcsolat'; }
		}
	}
	if(isset($this->request->here) && $this->request->here=='/akciok.html'){ $active = 'akciok'; }


?>
					<li class="<?php if($active=='home'){echo "active ";}?>hidden-sm hidden-md"><a href="/">Kezdőlap</a></li>
						<li class="<?php if($active=='home'){echo "active ";}?>hidden-xs hidden-lg"><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
					<!--li class="<?php //if($active=='akciok'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/akciok.html">Akciók</a></li-->
					<!--li class="<?php if($active=='akciok'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/akciok.html">Akciók</a></li-->
					<li class="<?php if($active=='akciok'){echo "active ";}?>"><a href="/akciok.html">Akciók</a></li>
					<li class="<?php if($active=='csomagok'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/csomagok.html">Csomagok</a></li>
					<li class="<?php if($active=='kabeltv'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/kabeltv.html">Kábel TV</a></li>
					<li class="<?php if($active=='internet'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/internet.html">Internet</a></li>
					<li class="<?php if($active=='telefon'){echo "active ";}?>"><a href="/csomagok/<?= $currentCityId ?>/telefon.html">Telefon</a></li>
					<!--li class="<?php //if($active=='mobil'){echo "active ";}?>"><a href="/mobil.html">Mobil</a></li-->
					<li class="<?php if($active=='hirek'){echo "active ";}?>"><a href="/hirek.html">Hírek <i class="icon-angle-down"></i></a></li>
					<li class="<?php if($active=='kapcsolat'){echo "active ";}?>hidden-sm hidden-md"><a href="/kapcsolat.html">Kapcsolat</a></li>
					<li class="<?php if($active=='kapcsolat'){echo "active ";}?>hidden-xs hidden-lg"><a href="/kapcsolat.html"><span class="glyphicon glyphicon-envelope"></span></a></li>
					<li class="<?php if($active=='rtlmost'){echo "active rtlmost";}?>"><a href="/rtlmost"><img src="/images/rtlmost_small.png" style="margin-top: -3px; height: 20px;"><i class="icon-angle-down"></i></a></li>

					<!--li class="hidden-sm hidden-md"><a href="http://bolytv.hu" target="_blank">BólyTV</a></li-->
					<li id="li-btv-png" title="Ugrás a BólyTV oldalára..." class="hidden-sm"><a style="padding: 1px 7px; margin-left: 5px;" href="http://bolytv.hu" target="_top"><img id="btv-png" style="height: 30px; margin-top: 0px;" src="/images/btv-logo.png" /></a></li>
				</ul>
			</div>
		</div>
	</header><!--/header-->

	<?= $this->element('carousel') ?>

	<?php
		if (date("Y-m-d") <= '2020-11-27') {
			echo $this->element('free_internet');
		}
	?>

	<?= $this->cell('Bottom') //CELL, mert az Abouts #1 -ből jönnek az adatok ?>

	<?= $this->element('title') ?>

<!--
--------------------------------------------------------------------------------------------------------------------------------
-----------------------------------------------------  C O N T E N T        ----------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------
-->
<section id="content" style="padding-top: 20px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?= $this->Flash->render() ?>
				<?= $this->Flash->render('auth') ?>
			</div>
		</div>
	</div>
	<div id="blog" class="container">
		<div class="row">
			<aside class="col-sm-4 col-sm-push-8">

				<?= $this->element('child_on_internet'); ?>

				<?php	// Csak akkor jelenjen meg, ha az Internet van kiválasztva.
					if(isset($this->request->params['pass'][1]) && $this->request->params['pass'][1] == 'internet.html'){
						echo $this->element('speedtest-link');
					}
				?>
				<?php
					if(!$simplePayMaintenance){
						echo $this->element('simplepay-link');
					}
				?>
				<?= $this->element('pdf-invoice-link'); ?>

				<?= $this->element('webmail-login') ?>


				<?php //= $this->element('search') ?>
				<?= $this->cell('Postcategories'); ?>
				<?= $this->cell('Labels'); ?>
				<?= $this->element('mecanatura'); ?>

				<?php //= $this->element('szechenyi-2018'); // GINOP-2.1.8-17-2017-01681.html ?>

				<?php /*
				<!--div class="widget facebook-fanpage">
					<h3>Karbantartási munkálatok</h3>
					<div class="widget-content">
						<div class="fb-like-box" data-href="https://www.facebook.com/shapebootstrap" data-width="292" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
				</div-->
				*/ ?>
			</aside>

			<?php
			//if(isset($this->request->cookies['currentCityId'])){
			//	echo $this->request->cookies['currentCityId'];
			//}else{
			//	echo "Nincs még település kiválasztva!";
			//}
			?>

			<?= $this->fetch('content') ?>


			<?= $this->element('clear-both-link_sm-xs'); ?>
			<hr>

			<?= $this->element('child_on_internet_sm-xs'); ?>

			<?php
				if(!$simplePayMaintenance){
					echo $this->element('simplepay-link_sm-xs');
				}
			?>
			<?= $this->element('pdf-invoice-link_sm-xs'); ?>

			<hr>
			<div class="widget border-sm-xs hidden-lg hidden-md visible-sm visible-xs">
				<a href="http://mecenatura.mtva.hu/" target="_blank"><img src="/images/mediatanacs-mecanatura.jpg" style="width: 100%;"></a>
			</div>
			<img src="/images/shadow.png" class="hidden-lg hidden-md" style="height: 20px; width:100%; margin-bottom: 20px;" />
			<hr>
<?php /*
			<div class="widget hidden-lg hidden-md visible-sm visible-xs">
				<a href="/GINOP-2.1.8-17-2017-01681.html" target="_blank">
					<img class="img-responsive" src="/images/szechenyi-2018.jpg">
					<!--img class="hidden-lg hidden-md hidden-sm img-responsive" src="/images/szechenyi-2018-xs.jpg"-->
				</a>
			</div>
			<hr>
*/ ?>
			<div class="widget webmail hidden-lg hidden-md">
				<div class="box box-info">
					<div class="box-header with-border col-sm-12">
						<h3 class="box-title text-center"><?= __('Webmail belépés') ?></h3>
					</div>
					<div class="box-body">
						<form method="post" action="https://webmail2.saghysat.hu/?_task=mail">

							<div class="input-group">
								<label for="rcmloginuser" class="control-label">Email:</label>
								<input name="_user" title="Email" id="rcmloginuser" type="text" class="form-control" autocomplete="off" placeholder="Email" style="width: 100%;">
								<span class="input-group-btn"></span>
							</div>
							<br>
							<div class="input-group">
								<label for="rcmloginpwd" class="control-label">Jelszó:</label>
								<input name="_pass" title="Jelszó" id="rcmloginpwd" type="password" class="form-control" autocomplete="off" placeholder="Jelszó" style="width: 100%;">
								<span class="input-group-btn"></span>
							</div>
							<br>
							<div class="input-group">
								<input value="Belépés" id="mailsubmit" type="submit" class="btn btn-default" style="width: 100%;">
								<input value="login" name="_action" type="hidden">
								<input value="webmail2.saghysat.hu" name="_host" type="hidden">
							</div>
						</form>
					</div>
				</div>
			</div><!--/.webmail-->
			<img src="/images/shadow.png" class="hidden-lg hidden-md" style="height: 20px; width:100%; margin-bottom: 20px;" />




		</div>
	</div><!--/#blog-->
</section>
<!--
------------------------------------------------------  /C O N T E N T        ---------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------
-->


	<?= $this->cell('Footer') //CELL, mert az Abouts #1 -ből jönnek az adatok ?>

	<footer id="footer" class="midnight-blue">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					2018 <a target="_blank" href="http://saghysat.hu" title="Sághy-Sat Kft.">Sághy-Sat&nbsp;Kft.</a> &copy;&nbsp;Minden&nbsp;jog&nbsp;fenntartva
				</div>
				<div class="col-sm-8 col-xs-12">
					<ul class="pull-right">
						<li><a href="/">Kezdőlap</a></li>
						<li><a href="/akciok.html">Akciók</a></li>
						<li><a href="/csomagok/<?= $currentCityId ?>/csomagok.html">Csomagok</a></li>
						<li><a href="/csomagok/<?= $currentCityId ?>/kabeltv.html">Kábel TV</a></li>
						<li><a href="/csomagok/<?= $currentCityId ?>/internet.html">Internet</a></li>
						<li><a href="/csomagok/<?= $currentCityId ?>/telefon.html">Telefon</a></li>
						<!--li><a href="/mobil.html">Mobil</a></li-->
						<li><a href="/hirek.html">Hírek</a></li>
						<li><a id="gototop" class="gototop" href="#" title="Ugrás az oldal tetejére"><i class="fa fa-angle-up"></i></a></li><!--#gototop-->
					</ul>
				</div>
			</div>
		</div>
	</footer><!--/#footer-->

	<div class="modal fade" id="modal-message" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"></h4>
	      </div>
	      <div class="modal-body">
	        <p></p>
	      </div>
	      <div class="modal-footer">
	        <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
	        <button type="button" class="btn btn-primary" data-dismiss="modal"></button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<?php if( (isset($this->request->params['pass'][1]) && ($this->request->params['pass'][1]=='akciok.html' || $this->request->params['pass'][1]=='csomagok.html' || $this->request->params['pass'][1]=='kabeltv.html' || $this->request->params['pass'][1]=='internet.html' || $this->request->params['pass'][1]=='telefon.html')) && ((isset($promptCityId) && $promptCityId===true) || !isset($currentCityId) || (isset($currentCityId) && $currentCityId==0)) ){ ?>
	<div class="modal fade" id="modalSelectCity" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  <!--div class="modal-dialog" role="document" style="margin-top: 150px;"-->
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="background: #eef;">
	      <div class="modal-header">
	        <h2 class="modal-title text-center">Kérem válasszon települést</h2>
	      </div>
	      <div class="modal-body">

			<div class="form-group">
				<div class="col-sm-12 col-md-12 col-xs-12">
					<input id="pass1" type="hidden" value="<?= $this->request->params['pass'][1] ?>" >
					<div style="display: none;">
	<?php
		debug($cities->toArray());
		//debug($this->request->params['controller']); die();
	?>
					</div>

					<?= $this->Form->input('city', ['options'=>$cities, 'default'=>$currentCityId, 'id'=>'selectedCityInit', 'data-size'=>'15', 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Kérem válasszon települést', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>

	      </div>

	    </div>
	  </div>
	</div>
<?php } ?>

<?php if($this->request->params['action']=="individualPackage") { 	//Ha egyéni csomag összeállítás van	?>
	<script src="/js/highlight.js"></script>
	<script src="/js/bootstrap-switch.min.js"></script>
	<script src="/js/bootstrap-switch-main.js"></script>
<?php } ?>
	<!--script src="/js/popover.js"></script-->
	<!-- script src="/js/jquery.prettyPhoto.js"></script -->
	<script src="/js/bootstrap-select.min.js"></script><!-- Bootstrap SELECT -->
	<script src="/js/jquery.cookie.js"></script><!-- jQuery COOKIE -->
	<script src="/js/main.js"></script>

<?php /* if( $this->request->here == '/kapcsolat.html') { ?>
	<script src="http://maps.googleapis.com/maps/api/js"></script>  <!-- Add Google Maps -->
	<script>
		var myCenter = new google.maps.LatLng(45.966785, 18.516892);
		function initialize() {
			var mapProp = {
				center:myCenter,
				zoom:12,
				scrollwheel:false,
				draggable:false,
				mapTypeId:google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
			var marker = new google.maps.Marker({
				position:myCenter,
			});
			marker.setMap(map);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
<?php } */ ?>

<!--
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
 █████████████████████████████████████████████████████  ### S C R I P T ###  ███████████████████████████████████████████████████
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
 ███████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
-->
	<script>
	$(document).ready(function(){

		$('[data-toggle="popover"]').popover();

		$("#li-btv-png").hover(
		  function() {
			$("#btv-png").attr('src','/images/btv-logo-white.png');
		  }, function() {
			$("#btv-png").attr('src','/images/btv-logo.png');
		  }
		);

		$("#selectedCityInit").change( function(){
			//- 1. - $.cookie('currentCityId', $('#selectedCityInit').val(), { expires: 365, path: '/' });
			$.cookie('currentCityId', $('#selectedCityInit').val(), { expires: null, path: '/' });
<?php if(isset($this->request->params['pass'][1]) && $this->request->params['action'] == 'index'){ ?>
			window.location.href = '/csomagok/'+$(this).val()+'/<?= $this->request->params['pass'][1] ?>';
<?php } ?>
<?php if(isset($this->request->params['pass'][1]) && $this->request->params['action'] == 'individual'){ ?>
			window.location.href = '/egyedi-csomag/'+$(this).val()+'/<?= $this->request->params['pass'][1] ?>';
<?php } ?>
		});


		$("#selectedCity").change( function(){
			<?php /*
				console.log($(this).val());
				console.log(<?php echo $cookie_id; ?>);
			*/ ?>
<?php //if($this->request->params['_matchedRoute']=='/egyedi-csomag/*' && $this->request->params['action']=='index'){ ?>
<?php if(isset($this->request->params['pass'][1]) && $this->request->params['action']=='index'){ ?>
		window.location.href = '/csomagok/'+$(this).val()+'/<?= $this->request->params['pass'][1] ?>';
<?php } ?>
<?php //if($this->request->params['_matchedRoute']=='/csomagok/*' && $this->request->params['action']=='individual'){ ?>
<?php if($this->request->params['action']=='individual'){ ?>
			window.location.href = '/egyedi-csomag/'+$(this).val()+'/<?php if(isset($this->request->params['pass'][1])){ echo $this->request->params['pass'][1]; }else{echo "internet.html";} ?>';
			<?php /*//alert( '/egyedi-csomag/'+$(this).val()+'/'+$('#pass1').val() ); ?>			//window.location.href = '/egyedi-csomag/'+$(this).val()+'/'+$('#pass1').val() */ ?>
<?php } ?>
		});	//$("#selectedCity").change()

<?php if(isset($cookie_id)){ ?>
		if($.cookie('cookieId') != "<?php echo $cookie_id; ?>"){
			$.cookie('cookieId', '<?php echo $cookie_id; ?>', { expires: 365, path: '/' });
		}
<?php } ?>

<?php
	/*	//-- TESZT --
	alert( '<?= $currentCityId ?>'+' '+$.cookie('currentCityId') );
	*/

	if($currentCityId>0){ ?>
		if($.cookie('currentCityId') != '<?php echo $currentCityId; ?>'){
			$.cookie('currentCityId', '<?php echo $currentCityId; ?>', { expires: null, path: '/' });
		}
<?php }else{ //Ha be kell kérni a település, akkor feljön a modal...
			if( (
					isset($this->request->params['pass'][1])
					&&
					(	$this->request->params['pass'][1]=='akciok.html'
						||
						$this->request->params['pass'][1]=='csomagok.html'
						||
						$this->request->params['pass'][1]=='kabeltv.html'
						||
						$this->request->params['pass'][1]=='internet.html'
						||
						$this->request->params['pass'][1]=='telefon.html'
					)
				)
				&&
				(
					//!isset($this->request->cookies['currentCityId'])
					//||
					//(isset($this->request->cookies['currentCityId']) && $this->request->cookies['currentCityId']==0)

					//(isset($promptCityId) && $promptCityId==true)
					//||
					$currentCityId==0
				)
			){
?>
			//alert('<?php //= $currentCityId ?>');
			$('#modalSelectCity').modal('show');
<?php
			}
	  }
?>

	});
	<?php /*
		alert('<?= $currentCityId ?>');
	*/ ?>
	</script>





<?php if($this->request->params['action']=='individual' || $this->request->params['action']=='pay' ){ ?>
	<script src="/plugins/icheck-1.x/icheck.min.js"></script>
<?php } ?>
	<script>

	$(document).ready(function(){
<?php if($this->request->params['action']=='individual'){ ?>
		//--- Egyéni csomag összeállítás -----------
		$('input').each(function(){
			var self = $(this),
			  label = self.next(),
			  label_text = label.text();

			label.remove();
			self.iCheck({
			  checkboxClass: 'icheckbox_line-blue',
			  radioClass: 'iradio_line-blue',
			  insert: '<div class="icheck_line-icon"></div>' + label_text
			});
		});
<?php } ?>

<?php if($this->request->params['_matchedRoute']=='/kapcsolat.html' || $this->request->params['action'] == 'message_customer'){ ?>
		//--- Üzenet küldés -----------
		$('#send-message').click( function(){
			if( $("#name").val() == '' || $("#email").val() == '' || $("#phone").val() == '' || $("#subject").val() == '' || $("#body").val() == '' || !$("#cb_gdpr").is(":checked") ){
				alert('Kérem töltse ki a *-gal jelölt mezőket!');
			}else{
				if($( "#cb_gdpr" ).is( ":checked" )) {
					$("#contact-form").submit();
				}else{
					alert('Üzenet küldés csak az "Adatkezelési szabályzatot" elfogadásával lehetséges!');
				}
			}
		});

		//--- Üzenet küldés ügyfeleknek -----------
		$('#send-message2').click( function(){
			var customer_id = $("#customer-id").val();
			if( customer_id == '' || $("#address2").val() == '' || $("#name2").val() == '' || $("#email2").val() == '' || $("#phone2").val() == '' || $("#subject2").val() == '' || $("#body2").val() == '' || !$("#cb_gdpr2").is(":checked") ){
				alert('Kérem töltse ki a *-gal jelölt mezőket!');
			}else{
				if($( "#cb_gdpr2" ).is( ":checked" )) {
					if( customer_id.substr(0,3) == 'ID0' && customer_id.length == 8 ){
						$("#contact-form2").submit();
					}else{
						alert('Az ügyfélszámot kérem írja egybe szóközök nélkül! Helyes formátuma (a minta alapján is): nagy ID, majd NULLÁ-k és nem O betűk, majd az ön száma következik!');
					}
				}else{
					alert('Üzenet küldés csak az "Adatkezelési szabályzatot" elfogadásával lehetséges!');
				}
			}
		});
<?php } ?>

	});
</script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=hu&privacyPage=%2Fadatkezelesi-nyilatkozat.html"></script>

<?php
	/*
		<pre>
		echo $this->request->session()->read('currentCityId');
		</pre>
	*/
?>
<?php
		//debug($this->request->url);
?>
<script>
	$(function () {
		$('[data-toggle="popover"]').popover({ trigger: "hover" });
<?php /*
if($this->request->params['controller']=='Simplepays' && $this->request->params['action']=='pay'){ ?>

		$('#cb_gdpr').iCheck({
			checkboxClass: 'icheckbox_minimal'
		});

<?php }
*/ ?>
	})
</script>


<?php if( $this->request->params['_matchedRoute']=='/simplepay/back' ){ ?>
	<script src="/plugins/jQueryCountdown/jquery.time-to.min.js"></script>
    <script>
<?php //if($message['r'] == 'SUCCESS'){ ?>
<?php if($message['success']){ ?>

	$(document).ready( function() {

		var successText = "Sikeres fizetés";
		var ipnOk = false;
		$("#back-success").hide();

		function showOk()
		{
			$('#countdown').timeTo('stop');
			$('#countdown').fadeOut(500, function(){
				$("#message").text(successText);
				$("#back-success").fadeIn(500);
				$("#main-title").fadeOut( function(){
					$("#main-title").text(successText);
					$("#main-title").fadeIn();
				});
				$("#sub-title").fadeOut( function(){
					$("#sub-title").text(successText);
					$("#sub-title").fadeIn();
				});
			});
		}

        $('#countdown').timeTo(30, function()
		{
			if( ipnOk == false ){
				$('#countdown').timeTo('reset');
			}else{
				showOk();
			}
        });

		function checkIpn()
		{
			if( ipnOk == false ){
				data = {'orderRef': $("#orderRef").text()}
				$.ajax({
					type: "POST",
					cache: false,
					url: "/simplepay/checkIpn",
					dataType: 'json',
					data: JSON.stringify(data),
					success: function(response){
						if(response.success){
							ipnOk = true;
							showOk();
						}
					}
				});
			}

			if( ipnOk == false ){
				setTimeout(function () {
					checkIpn();
				}, 2000);
			}
		}
		if( ipnOk == false ){
			checkIpn();
		}

	});

<?php }else{ ?>
	var successText = "Sikertelen fizetés!";
	$(document).ready( function(){
		$('#countdown').hide();
		$('#countdown').timeTo('stop');
		$("#message").text(successText);
		$("#back-success").fadeIn(500);
		$("#main-title").fadeOut( function(){
			$("#main-title").text(successText);
			$("#main-title").fadeIn();
		});
		$("#sub-title").fadeOut( function(){
			$("#sub-title").text(successText);
			$("#sub-title").fadeIn();
		});
	});

<?php } ?>
    </script>
<?php } ?>

<?php //debug($message) ?>

</body>
</html>
