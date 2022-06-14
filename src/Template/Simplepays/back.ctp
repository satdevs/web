<!-- -------------------------------- FORM -------------------------------- -->
    <div id="contact" class="col-sm-8 col-sm-pull-4">
        <div class="blog">
			<div class="blog-item">

				<div class="form-group" style="padding-bottom: 20px;">
					<div class="col-sm-12 col-xs-12 text-center">
						<h2 id="sub-title"><?= $message['message'] ?></h2>
					</div>
					<div class="col-sm-12 col-xs-12 text-right">
						<a href="http://simplepartner.hu/PaymentService/Fizetesi_tajekoztato.pdf" target="_blank">
							<img 
								src="/images/simplepay/simplepay_bankcard_logos_left_482x40.png" 
								title="SimplePay - Online bankkártyás fizetés"
								alt="SimplePay vásárlói tájékoztató"
								class="img-responsive"
								style="margin: 20px auto 0px;"
							/>
						</a>
					</div>
				</div>

				<div style="clear: both;"></div>
				<hr>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

					<?php
						$color = 'red';
						//if($message['r'] == 'SUCCESS'){
						if($message['success']){
							$color = 'green';
						}
					?>

					<div style="padding: 20px; margin-bottom: 20px; border: 5px solid <?= $color ?>; width: 100%;">

						<div id="countdown"></div>
					
						<div id="back-success">
							<h3><span id="message" style="font-weight: bold;"><?= $message['message'] ?></span></h3>
								<p>SimplePay tranzakció azonosító: <b id="transaction-id"><?= $message['t'] ?></b></p>
								<p>Referencia szám: <span id="orderRef" style="font-weight: bold;"><?= $message['o'] ?></span></p>
							<p style="margin: 15px;"><b id="simple-message"><?= $message['thx'] ?></b></p>
							<?php
								$color = 'red';
								if($message['success']){
							?>
									<a href="/" class="btn btn-md btn-success">Tovább a főoldalra!</a>
									
									<div class="col-md-12 text-center" style="margin: 10px; margin-top: 15px;">
										<p style="font-weight: bold;">Amennyiben még nem igényelt PDF számlát a papír alapú számla helyett, akkor az alábbi zöld gombra kattintva megteheti.</p>
										<a href="/pdfszamla" class="btn btn-md btn-success" style="margin: 15px;">Tovább a PDF számla igényléséhez...</a>
									</div>
							<?php						
								}else{
							?>
									<a href="/simplepay" class="btn btn-md btn-danger">Vissza a fizetés oldalra!</a>
							<?php
								}
							?>


						
						</div>
						
					</div>
					
				</div>
			
			</div>
			
        </div>
        <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

    </div>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->

