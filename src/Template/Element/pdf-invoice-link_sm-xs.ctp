<?php if(substr($this->request->params['_matchedRoute'], 0, 10) != '/pdfszamla' && substr($this->request->params['_matchedRoute'], 0, 10) != '/pdfszamla-adatlap'){ ?>
<?php //debug($this->request->params['_matchedRoute']); ?>
				<div class="widget webmail border-sm-xs hidden-md hidden-lg">
					<div class="box box-info">
						<div class="box-header with-border col-sm-12" style="background: #63B32E; padding: 5px; margin-bottom: 10px;">
							<h3 class="box-title text-center" style="color: white; font-weight: bold;"><?= __('PDF Számla') ?></h3>
						</div>
						<div class="box-body text-center">
							<img src="/images/free-pdf-icon.png" class="img-responsive" style="width: 64px; margin: 10px auto;" />
							<div style="clear: both;"></div>
							<b>Igényeljen PDF számlát papír alapú számla helyett!</b><br>
							Azoknál az ügyfeleknél, akik igénylik, e-mailben küldjük el a számlájukat.
							PDF számla igényét regisztrálhatja az alábbi zöld gombra való kattintással!
							<div style="clear: both;"></div>
							<a href="/pdfszamla" class="btn btn-success btn-lg" style="margin: 20px 0px 10px;">PDF számla regisztráció</a>
						</div>
					</div>
				</div><!--/.webmail-->
				<img src="/images/shadow.png" class="hidden-md hidden-lg" style="height: 20px; width:100%; margin-bottom: 20px;" />
<?php } ?>
