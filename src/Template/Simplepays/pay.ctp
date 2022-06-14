<!-- -------------------------------- FORM -------------------------------- -->
    <div id="simplepay" class="col-sm-8 col-sm-pull-4">
        <div class="blog">
			<div class="blog-item">

				<div class="form-group" style="padding-bottom: 0px;">
					<!--div class="col-sm-12 col-xs-12 text-center">
						<h2>Számla befizetése</h2>
					</div-->
					<div class="col-sm-12 col-xs-12 text-right">
						<a href="http://simplepartner.hu/PaymentService/Fizetesi_tajekoztato.pdf" target="_blank">
							<img
								src="/images/simplepay/simplepay_bankcard_logos_left_482x40_new.png"
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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
					<a class="btn btn-danger btn-lg" role="button" data-toggle="collapse" href="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp" style="margin-bottom: 20px;">
					  Hol találom a befizetőazonosítómat?
					</a>
					<div class="collapse" id="collapseHelp" style="margin-bottom: 20px;">
					  <div class="well text-center">
						<p><b>Hol találom a befizetőazonosítómat?</b><br>A számlán a nyilakkal jelölt helyen található a befizetőazonosító és a név.<br><span style="color: red; font-weight: bold;">A befizetőazonosító "IDS" <u>nagybetűkkel</u> kezdődik</span>!<br>

						</p>
						<img src="/images/simplepay_help.jpg" class="img-responsive"  style="-webkit-box-shadow: -1px 0px 15px 1px #000000; box-shadow: -1px 0px 15px 1px #000000;" />
						<br>
						<span style="color: black;"><i>Az fenti számlakép csak minta! Nem tartalmaz valós adatokat!</i></span>
					  </div>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				  <!-- Tab panes -->
<?php if( $simplePayMaintenance ){ ?>
					<h1 style="margin: 10px; margin-top: 0px; text-align: center; color: red; font-weight: bold;">K A R B A N T A R T Á S !</h1>
					<h3 style="margin: 10px; margin-bottom: 20px; text-align: center; color: red; font-weight: bold; font-size: 18px;">Ne indítson fizetési tranzakciót!<br>Kérem nézzen vissza később!</h3>
<?php } ?>


					<?= $this->Form->create($simplepay,['class'=>'form-horizontal', 'id'=>'payform', 'url' => ['action'=>'pay']]) ?>

						<div class="form-group">
							<label for="sub_id" class="col-sm-3 control-label">*Befizetőazonosító:</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('ids', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'A számla bal felső sarkánál található', 'required' => true]); ?>
								<p style="margin: 0px 3px 6px;">A számla bal felső sarkánál található befizető azonosító<br>
								pl.: <b>ID<span style="color: red;">S</span>10012345</b> (nagybetűkkel, egybeírva)!</p>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-sm-3 control-label">*Befizető neve:</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder' => 'A teljes nevét írja be!', 'required' => true ]); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">*E-mail:</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('email', ['email' => 'email', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder' => 'Az e-mail címe, ahova a visszaigazolát kéri.', 'required' => true ]); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="amount" class="col-sm-3 control-label">*Összeg (forint):</label>
							<div class="col-sm-8">
								<?php echo $this->Form->input('amount', ['type'=>'number', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'value' => '', 'placeholder' => 'Csak számokat írjon, szóközök nélkül!!!', 'required' => true ]); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="none" class="col-md-3 control-label">&nbsp;</label>
							<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
								<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#gdprModal" style="margin: 25px; margin-top: 10px;">
									Adatkezelési nyilatkozat
								</button>

								<div class="icheck-turquoise">
									<input type="checkbox" id="cb_gdpr" name="cb_gdpr"<?php if(isset($simplepay->cb_gdpr) && $simplepay->cb_gdpr==1){echo " checked";} ?> required />
									<label for="cb_gdpr">* Adatkezelési nyilatkozatot elolvastam és elfogadom</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 text-center">
								<?= $this->Form->button('<i class="fa fa-fw fa-send"></i> Befizetés indítása',['class'=>'btn btn-primary btn-lg', 'id'=>'send-message2', 'type'=>'submit']) ?>
							</div>
						</div>
						<!--/div-->
					<?= $this->Form->end() ?>
					<p style="text-align: right; font-style: italic; margin: 6px 3px;">Csillaggal jelölt mezők kitöltése kötelező!</p>

				</div>

			</div>

        </div>
        <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

    </div>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->



<!-- Modal -->
<div class="modal fade" id="gdprModal" tabindex="-1" role="dialog" aria-labelledby="gdpeLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gdpeLabel"><?= $gdpr->title ?></h4>
      </div>
      <div class="modal-body">
        <?= $gdpr->text ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Elolvastam</button>
      </div>
    </div>
  </div>
</div>

