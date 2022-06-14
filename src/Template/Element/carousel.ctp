
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
							<h2 style="color: #fff; margin-top: 0px;" class="animation animated-item-1">Akciós készülék vásár előfizetőinknek</h2>
							<p style="color: #fff;" class="animation animated-item-2">Most cserélje régi készülékét</p>
							<p style="float: left; margin-top: 20px; color: gray;" class="animation animated-item-3"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p style="float: left; margin-left: 20px; font-size: 44px;clear: both;" class="animation animated-item-4">94&nbsp;999&nbsp;Ft</p>
							<a style="float: left; margin-left: 120px;" class="animation animated-item-5 btn btn-primary btn-lg" href="/mobil.html">Érdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div-->
<?php /*
						<div class="carousel-caption" style="width: 1132px; padding-top: 0px;">
							<h2 class="animation animated-item-1" style="margin-top: 0px;">Akciós készülék vásár előfizetőinknek</h2>
							<p class="animation animated-item-2" style="color: red;">Most cserélje régi készülékét</p>
							<p class="animation animated-item-6" style="float: left; margin-top: 20px; color: gray;"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p class="animation animated-item-7" style="float: left; margin-left: 20px; font-size: 44px;clear: both;">94&nbsp;999&nbsp;Ft</p>
							<a href="/mobil.html" class="btn btn-primary btn-lg animation animated-item-9" style="float: left; margin-left: 120px;">Érdekel</a>
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
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Válasszon mobil előfizetést meglévő vezetékes előfizetése mellé</p>
							<br /><br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">Érdekel</a>
							<br /><br />
							<p class="animation animated-item-3">és az internetet két hónapig féláron adjuk.</p>
						</div-->
					</div>

					<div class="item" id="item-3">
						<img src="/images/slider/slide3.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Mobilcsomagok mellé<br>készülékek akár 1 forintért!</p>
							<br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">Érdekel</a>
							<br /><br />
							<p class="animation animated-item-3" style="font-size: 32px;">Havidíj <span style="font-size: 50px;">2600&nbsp;Ft</span>-tól!</p>
						</div-->
					</div>
<?php /*					
					<div class="item" id="item-3">
						<img src="/images/slider/slide4.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Válasszon mobilszolgáltatást meglévő vezetékes előfizetése mellé</p>
							<p class="animation animated-item-3">és vezetékes telefonjáról 2999&nbsp;FT/hó előfizetési díj ellenében:</p>
							<p class="animation animated-item-4"><span style="font-size:28px; font-weight: bold; color:red;">KORLÁTLANUL beszélhet<br>belföldi mobil és vezetékes irányba</span></p>
							<a class="btn btn-primary btn-lg animation animated-item-6" href="/mobil.html">Érdekel</a>
							<p class="animation animated-item-5" style="font-size: 32px;">Havidíj <span style="font-size: 50px;">2&nbsp;999</span>&nbsp;Ft!</p>
						</div-->
					</div>
*/ ?>




<?php }else{ ?>



					<div class="item active" id="item-0">
						<img src="/images/slider/slide1.jpg" alt="" class="img-responsive">

						<!--div class="carousel-caption" style="width: 1132px; padding-top: 0px; background: #bbb; margin-left: auto; margin-right: auto;">
							<h2 style="color: #fff; margin-top: 0px;" class="animation animated-item-1">Akciós készülék vásár előfizetőinknek</h2>
							<p style="color: #fff;" class="animation animated-item-2">Most cserélje régi készülékét</p>
							<p style="float: left; margin-top: 20px; color: gray;" class="animation animated-item-3"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p style="float: left; margin-left: 20px; font-size: 44px;clear: both;" class="animation animated-item-4">94&nbsp;999&nbsp;Ft</p>
							<a style="float: left; margin-left: 120px;" class="animation animated-item-5 btn btn-primary btn-lg" href="/mobil.html">Érdekel</a>
							<div style="clear: both;"></div>
							<img src="/images/slider/analog-tv.png" alt="" class="img-responsive animation animated-item-3" style="float: left; margin-top: 0px;">
							<img src="/images/slider/nyil.png" alt="" class="img-responsive animation animated-item-4" style="float: left;margin-left: 40px; margin-top: 80px;">
							<img src="/images/slider/lapos-tv.png" alt="" class="img-responsive animation animated-item-5" style="float: right; margin-top: -140px;">
						</div-->
<?php /*
						<div class="carousel-caption" style="width: 1132px; padding-top: 0px;">
							<h2 class="animation animated-item-1" style="margin-top: 0px;">Akciós készülék vásár előfizetőinknek</h2>
							<p class="animation animated-item-2" style="color: red;">Most cserélje régi készülékét</p>
							<p class="animation animated-item-6" style="float: left; margin-top: 20px; color: gray;"><span style="text-decoration: line-through;">109&nbsp;900&nbsp;Ft</span></p>
							<p class="animation animated-item-7" style="float: left; margin-left: 20px; font-size: 44px;clear: both;">94&nbsp;999&nbsp;Ft</p>
							<a href="/mobil.html" class="btn btn-primary btn-lg animation animated-item-9" style="float: left; margin-left: 120px;">Érdekel</a>
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
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Válasszon mobil előfizetést meglévő vezetékes előfizetése mellé</p>
							<br /><br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">Érdekel</a>
							<br /><br />
							<p class="animation animated-item-3">és az internetet két hónapig féláron adjuk.</p>
						</div-->
					</div>

					<div class="item" id="item-2">
						<img src="/images/slider/slide3.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Mobilcsomagok mellé<br>készülékek akár 1 forintért!</p>
							<br />
							<a class="btn btn-primary btn-lg animation animated-item-4" href="/mobil.html">Érdekel</a>
							<br /><br />
							<p class="animation animated-item-3" style="font-size: 32px;">Havidíj <span style="font-size: 50px;">2600&nbsp;Ft</span>-tól!</p>
						</div-->
					</div>
<?php /*					
					<div class="item" id="item-3">
						<img src="/images/slider/slide4.jpg" alt="" class="img-responsive">
						<!--div class="carousel-caption">
							<h2 class="animation animated-item-1">Már mobilban is utazunk</h2>
							<p class="animation animated-item-2">Válasszon mobilszolgáltatást meglévő vezetékes előfizetése mellé</p>
							<p class="animation animated-item-3">és vezetékes telefonjáról 2999&nbsp;FT/hó előfizetési díj ellenében:</p>
							<p class="animation animated-item-4"><span style="font-size:28px; font-weight: bold; color:red;">KORLÁTLANUL beszélhet<br>belföldi mobil és vezetékes irányba</span></p>
							<a class="btn btn-primary btn-lg animation animated-item-6" href="/mobil.html">Érdekel</a>
							<p class="animation animated-item-5" style="font-size: 32px;">Havidíj <span style="font-size: 50px;">2&nbsp;999</span>&nbsp;Ft!</p>
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
