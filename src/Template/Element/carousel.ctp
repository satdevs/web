
<!--
------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
-->
<?php if( isset($this->request->params['controller']) && $this->request->params['controller']='Posts' && isset($this->request->params['action']) &&  $this->request->params['action']=='index' && isset($this->request->params['pass'][0]) && $this->request->params['pass'][0] == 'home' ){ ?>
<?php //$this->request->here == "/" ){ ?>

	<section id="main-slider" class="no-margin" style="background: #fff;">
		<!--div class="container"-->
			<div class="carousel slide wet-asphalt">
				<!--ol class="carousel-indicators">
					<li data-target="#main-slider" data-slide-to="0" class="active"></li>
					<li data-target="#main-slider" data-slide-to="1"></li>
					<li data-target="#main-slider" data-slide-to="2"></li>
				</ol-->
				
				<ol class="carousel-indicators">
				
<?php if (date("Y-m-d") <= '2020-11-27') { ?>
					<li data-target="#main-slider" data-slide-to="0" class="active"></li>
					<li data-target="#main-slider" data-slide-to="1"></li>
					<li data-target="#main-slider" data-slide-to="2"></li>
					<li data-target="#main-slider" data-slide-to="3"></li>
<?php }else{ ?>
					<li data-target="#main-slider" data-slide-to="0" class="active"></li>
					<li data-target="#main-slider" data-slide-to="1"></li>
					<li data-target="#main-slider" data-slide-to="2"></li>
<?php } ?>
					
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">


<?php if (date("Y-m-d") <= '2020-11-29') { ?>
					<div class="item active" id="item-0">
						<img src="/images/slider/slide0.jpg" alt="" class="img-responsive">

						<div class="carousel-caption" style="width: 1132px; padding-top: 0px;">

						</div>

					</div>


					<div class="item" id="item-1">
						<img src="/images/slider/slide1.jpg" alt="" class="img-responsive">

						<!--div class="carousel-caption" style="width: 1132px; padding-top: 0px; background: #bbb; margin-left: auto; margin-right: auto;">
							<h2 style="color: #fff; margin-top: 0px;" class="animation animated-item-1">Akci??s k??sz??l??k v??s??r el??fizet??inknek</h2>
							<p style="color: #fff;" class="animation animated-item-2">Most cser??lje r??gi k??sz??l??k??t</p>
							<p style="float: left; margin-top: 20px; color: gray;" class="animation animated-item-3"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p style="float: left; margin-left: 20px; font-size: 44px;clear: both;" class="animation animated-item-4">94&nbsp;999&nbsp;Ft</p>
							<a style="float: left; margin-left: 120px;" class="animation animated-item-5 btn btn-primary btn-lg" href="/mobil.html">??rdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div-->
<?php /*
						<div class="carousel-caption" style="width: 1132px; padding-top: 0px;">
							<h2 class="animation animated-item-1" style="margin-top: 0px;">Akci??s k??sz??l??k v??s??r el??fizet??inknek</h2>
							<p class="animation animated-item-2" style="color: red;">Most cser??lje r??gi k??sz??l??k??t</p>
							<p class="animation animated-item-6" style="float: left; margin-top: 20px; color: gray;"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p class="animation animated-item-7" style="float: left; margin-left: 20px; font-size: 44px;clear: both;">94&nbsp;999&nbsp;Ft</p>
							<a href="/mobil.html" class="btn btn-primary btn-lg animation animated-item-9" style="float: left; margin-left: 120px;">??rdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div>
*/ ?>

					</div>

					<div class="item" id="item-2">
						<img src="/images/slider/slide2.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">V??lasszon mobil el??fizet??st megl??v?? vezet??kes el??fizet??se mell??</p>
							<br /><br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">??rdekel</a>
							<br /><br />
							<p class="animation animated-item-3">??s az internetet k??t h??napig f??l??ron adjuk.</p>
						</div-->
					</div>

					<div class="item" id="item-3">
						<img src="/images/slider/slide3.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">Mobilcsomagok mell??<br>k??sz??l??kek ak??r 1 forint??rt!</p>
							<br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">??rdekel</a>
							<br /><br />
							<p class="animation animated-item-3" style="font-size: 32px;">Havid??j <span style="font-size: 50px;">2600&nbsp;Ft</span>-t??l!</p>
						</div-->
					</div>
<?php /*					
					<div class="item" id="item-3">
						<img src="/images/slider/slide4.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">V??lasszon mobilszolg??ltat??st megl??v?? vezet??kes el??fizet??se mell??</p>
							<p class="animation animated-item-3">??s vezet??kes telefonj??r??l 2999&nbsp;FT/h?? el??fizet??si d??j ellen??ben:</p>
							<p class="animation animated-item-4"><span style="font-size:28px; font-weight: bold; color:red;">KORL??TLANUL besz??lhet<br>belf??ldi mobil ??s vezet??kes ir??nyba</span></p>
							<a class="btn btn-primary btn-lg animation animated-item-6" href="/mobil.html">??rdekel</a>
							<p class="animation animated-item-5" style="font-size: 32px;">Havid??j <span style="font-size: 50px;">2&nbsp;999</span>&nbsp;Ft!</p>
						</div-->
					</div>
*/ ?>




<?php }else{ ?>



					<div class="item active" id="item-0">
						<img src="/images/slider/slide1.jpg" alt="" class="img-responsive">

						<!--div class="carousel-caption" style="width: 1132px; padding-top: 0px; background: #bbb; margin-left: auto; margin-right: auto;">
							<h2 style="color: #fff; margin-top: 0px;" class="animation animated-item-1">Akci??s k??sz??l??k v??s??r el??fizet??inknek</h2>
							<p style="color: #fff;" class="animation animated-item-2">Most cser??lje r??gi k??sz??l??k??t</p>
							<p style="float: left; margin-top: 20px; color: gray;" class="animation animated-item-3"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p style="float: left; margin-left: 20px; font-size: 44px;clear: both;" class="animation animated-item-4">94&nbsp;999&nbsp;Ft</p>
							<a style="float: left; margin-left: 120px;" class="animation animated-item-5 btn btn-primary btn-lg" href="/mobil.html">??rdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div-->
<?php /*
						<div class="carousel-caption" style="width: 1132px; padding-top: 0px;">
							<h2 class="animation animated-item-1" style="margin-top: 0px;">Akci??s k??sz??l??k v??s??r el??fizet??inknek</h2>
							<p class="animation animated-item-2" style="color: red;">Most cser??lje r??gi k??sz??l??k??t</p>
							<p class="animation animated-item-6" style="float: left; margin-top: 20px; color: gray;"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p class="animation animated-item-7" style="float: left; margin-left: 20px; font-size: 44px;clear: both;">94&nbsp;999&nbsp;Ft</p>
							<a href="/mobil.html" class="btn btn-primary btn-lg animation animated-item-9" style="float: left; margin-left: 120px;">??rdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div>
*/ ?>

					</div>

					<div class="item" id="item-1">
						<img src="/images/slider/slide2.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">V??lasszon mobil el??fizet??st megl??v?? vezet??kes el??fizet??se mell??</p>
							<br /><br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">??rdekel</a>
							<br /><br />
							<p class="animation animated-item-3">??s az internetet k??t h??napig f??l??ron adjuk.</p>
						</div-->
					</div>

					<div class="item" id="item-2">
						<img src="/images/slider/slide3.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">Mobilcsomagok mell??<br>k??sz??l??kek ak??r 1 forint??rt!</p>
							<br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">??rdekel</a>
							<br /><br />
							<p class="animation animated-item-3" style="font-size: 32px;">Havid??j <span style="font-size: 50px;">2600&nbsp;Ft</span>-t??l!</p>
						</div-->
					</div>
<?php /*					
					<div class="item" id="item-3">
						<img src="/images/slider/slide4.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">M??r mobilban is utazunk</h2>
							<p class="animation animated-item-2">V??lasszon mobilszolg??ltat??st megl??v?? vezet??kes el??fizet??se mell??</p>
							<p class="animation animated-item-3">??s vezet??kes telefonj??r??l 2999&nbsp;FT/h?? el??fizet??si d??j ellen??ben:</p>
							<p class="animation animated-item-4"><span style="font-size:28px; font-weight: bold; color:red;">KORL??TLANUL besz??lhet<br>belf??ldi mobil ??s vezet??kes ir??nyba</span></p>
							<a class="btn btn-primary btn-lg animation animated-item-6" href="/mobil.html">??rdekel</a>
							<p class="animation animated-item-5" style="font-size: 32px;">Havid??j <span style="font-size: 50px;">2&nbsp;999</span>&nbsp;Ft!</p>
						</div-->
					</div>
*/ ?>





<?php } ?>


				</div>
			</div><!--/.carousel-->
			<a class="prev hidden-xs" href="#main-slider" data-slide="prev">
				<i class="fa fa-chevron-left"></i>
			</a>
			<a class="next hidden-xs" href="#main-slider" data-slide="next">
				<i class="fa fa-chevron-right"></i>
			</a>
		<!--/div /////container  -->
		<!--div class="container">
			<div class="row">
				<img src="/images/img_shadow.png" alt="" style="width: 100%; height: 25px;">				
			</div>
		</div-->
	</section><!--/#main-slider-->
	
	<section id="carousel-shadow" style="padding: 0px;">
		<img src="/images/shadow.png" style="height: 40px; width:100%;" />
	</section>

<?php } ?>
