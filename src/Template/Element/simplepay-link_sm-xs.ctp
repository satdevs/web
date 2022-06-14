<?php if(substr($this->request->params['_matchedRoute'], 0, 10) != '/simplepay'){ ?>
<?php //debug($this->request->params['_matchedRoute']); ?>
				<div class="widget webmail border-sm-xs hidden-md hidden-lg">
					<div class="box box-info">
						<div class="box-header with-border col-sm-12" style="background: #63B32E; padding: 5px; margin-bottom: 10px;">
							<h3 class="box-title text-center" style="color: white; font-weight: bold;"><?= __('Számla befizetése') ?></h3>
						</div>
						<div class="box-body text-center">
							<img src="/images/simplepay/simplepay_bankcard_logos_top_01_new.jpg" class="img-responsive" />
							<a href="/simplepay" class="btn btn-success btn-lg" style="margin: 20px 0px 10px;">Ugrás a befizető oldalra</a>
						</div>
					</div>
				</div><!--/.webmail-->
				<img src="/images/shadow.png" class="hidden-md hidden-lg" style="height: 20px; width:100%; margin-bottom: 20px;" />
<?php } ?>
