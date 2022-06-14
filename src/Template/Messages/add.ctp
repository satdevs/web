<?php 
// debug($message);
?>
<!-- -------------------------------- FORM -------------------------------- -->
    <div id="contact" class="col-sm-8 col-sm-pull-4">
        <div class="blog">
			<div class="blog-item">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left" style="padding-bottom: 20px;">
				<h4><b>Sághy-Sat&nbsp;Kft.</b> 7754&nbsp;Bóly,&nbsp;Ady&nbsp;E.&nbsp;u.&nbsp;9.</h4>
			</div>
				
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<b><u>Telefon:</u></b><br>
				<ul>
					<li>+36 69/368-162</li>
					<li>+36 69/696-696</li>
					<li>+36 72/696-696</li>
					<li>+36 79-696-696</li>
				</ul>
				
				<b><u>Fax:</u></b><br>
				<ul>
					<li>+36 69/568-010</li>
				</ul>

			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<b><u>Ügyfélfogadás:</u></b><br>
				<ul>
					<li>Hétfő-Péntek: <b>8:00 - 16:00</b></li>
				</ul>
				
				<b><u>Hibabejelentés a nap 24 órájában:</u></b><br>
				<ul>
					<li>Tel.: +36 69/696-696</li>
				</ul>
				
				<b><u>E-mail:</u></b><br>
				<ul>
					<li><a href="mailto:info@saghysat.hu">info@saghysat.hu</a></li>
				</ul>			
			
			</div>
		
		
		
				<div style="clear: both;"></div>
                <h3 class="text-left" style="margin-top: 20px;">Üzenet küldése</h3>

				<div>
<?php
	$active1 = '';
	$active2 = '';
	$panelActive1 = '';
	$panelActive2 = '';
	if(isset($tab) && $tab==1){
		$active1 = ' class="active"';		
		$panelActive1 = ' active';
	}
	if(isset($tab) && $tab==2){
		$active2 = ' class="active"';
		$panelActive2 = ' active';
	}
?>
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation"<?= $active1 ?>><a href="#visitor" aria-controls="home" role="tab" data-toggle="tab">Látogató</a></li>
					<li role="presentation"<?= $active2 ?>><a href="#customer" aria-controls="profile" role="tab" data-toggle="tab">Meglévő előfizetőnk</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
					<div role="tabpanel" class="tab-pane<?= $panelActive1 ?>" id="visitor">

						<p style="text-align: right; font-style: italic; margin: 6px 3px;">Csillaggal jelölt mezők kitöltése kötelező!</p>
						<?= $this->Form->create($message, ['class'=>'form-horizontal', 'id'=>'contact-form']) ?>
						<?php echo $this->Form->input('tab', ['type'=>'hidden', 'style'=>'display: none;', 'value'=>1]); ?>
						<div class="box-body">
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Neve:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Email:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Telefon:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">Cím:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Szolgáltatási hely címe' ]); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Tárgy:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('subject', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Téma:</label>
								<div class="col-sm-5">
									<?php echo $this->Form->input('messagetheme_id', ['options' => $messagethemes, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false] ); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="group_id" class="col-sm-2 control-label">*Üzenete:</label>
								<div class="col-sm-10">
									<?php echo $this->Form->input('body', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="none" class="col-md-2 control-label">&nbsp;</label>
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<div class="icheck-turquoise">
										<input type="checkbox" id="cb_gdpr" name="cb_gdpr"<?php if(isset($message->cb_gdpr) && $message->cb_gdpr==1){echo " checked";} ?> />
										<label for="cb_gdpr">* Adatkezelési szabályzatot elfogadom</label>
										<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#gdprModal" style="float: right;">
											Adatkezelési szabályzat elolvasása
										</button>
									</div>						
								</div>
							</div>
								
						</div>

						<div class="form-group">
							<label for="group_id" class="col-sm-12 control-label" style="text-align: center;">Biztonsági kód:</label>
							<div class="col-sm-10" style="font-family: Consolas, Menlo, Monaco, 'Lucida Console', 'Liberation Mono', 'DejaVu Sans Mono', 'Bitstream Vera Sans Mono', 'Courier New', monospace, serif; font-size: 12px; border: 1px solid red; width: 100%; line-height: 5px; padding: 10px; text-align: center; font-size: 10px; letter-spacing: -1px; background: red;">
								<?= $captcha ?>
							</div>
						</div>            

						<div class="form-group">
							<label for="group_id" class="col-sm-12" style="color: red;">Írja be a fentebb olvasható biztonsági a kódot:</label>
							<div class="col-sm-12">
								<?php echo $this->Form->input('captcha', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'border: 1px solid red;' ]); ?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-12 text-center">
									<?= $this->Form->button('<i class="fa fa-fw fa-send"></i> Üzenet küldése',['class'=>'btn btn-primary btn-lg', 'id'=>'send-message', 'type'=>'button']) ?>
								</div>
							</div>
						</div>
						<!--/div-->
					<?= $this->Form->end() ?>

					
					
					
					</div>
					<div role="tabpanel" class="tab-pane<?= $panelActive2 ?>" id="customer">
					
						<p style="text-align: right; font-style: italic; margin: 6px 3px;">Csillaggal jelölt mezők kitöltése kötelező!</p>
						<?= $this->Form->create($message,['class'=>'form-horizontal', 'id'=>'contact-form2', 'url' => ['action'=>'message_customer']]) ?>
						<?php echo $this->Form->input('tab', ['type'=>'hidden', 'style'=>'display: none;', 'value'=>2]); ?>
						<div class="box-body">
						
							<div class="form-group">
							
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<label for="none" class="col-md-3 control-label">Szolgáltatás:</label>
									</div>
								</div>

								<div class="col-lg-3 col-md-3 col-sm-offset-3 col-sm-3 col-xs-6">
									<div class="icheck-turquoise">
										<input type="checkbox" name="cb_catv" id="cb_catv"<?php if(isset($message->cb_catv) && $message->cb_catv==1){echo " checked";} ?> />
										<label for="cb_catv">Kábel&nbsp;TV</label>
									</div>
								</div>
									
								<div class="col-md-3 col-sm-6 col-xs-6">
									<div class="icheck-turquoise">
										<input type="checkbox" name="cb_net" id="cb_net"<?php if(isset($message->cb_net) && $message->cb_net==1){echo " checked";} ?> />
										<label for="cb_net">Internet</label>
									</div>
								</div>
								
								<div class="col-lg-3 col-md-3 col-sm-offset-3 col-sm-3 col-xs-6">
									<div class="icheck-turquoise">
										<input type="checkbox" name="cb_tel" id="cb_tel"<?php if(isset($message->cb_tel) && $message->cb_tel==1){echo " checked";} ?> />
										<label for="cb_tel">Telefon</label>
									</div>
								</div>
								
								<div class="col-md-3 col-sm-6 col-xs-6">
									<div class="icheck-turquoise">
										<input type="checkbox" name="cb_digi" id="cb_digi"<?php if(isset($message->cb_digi) && $message->cb_digi==1){echo " checked";} ?> />
										<label for="cb_digi">Digitális&nbsp;TV</label>
									</div>
								</div>
								
							</div>
						
						
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Ügyfél&nbsp;szám:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('customer_id', ['type'=>'text', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Pl.: ID001234' ]); ?>
									<p style="margin: 0px 3px 6px;">Ügyfélszám formátuma pl.: <b>ID001234</b></p>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Neve:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('name2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Email:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('email2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Telefon:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('phone2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Cím:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('address2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'placeholder'=>'Szolgáltatási hely címe' ]); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Tárgy:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('subject2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>
							<!--div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Téma:</label>
								<div class="col-sm-5">
									<?php //echo $this->Form->input('messagetheme_id', ['options' => $messagethemes, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false] ); ?>
								</div>
							</div-->
							<div class="form-group">
								<label for="group_id" class="col-sm-3 control-label">*Üzenete:</label>
								<div class="col-sm-9">
									<?php echo $this->Form->input('body2', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
								</div>
							</div>            
							
							<div class="form-group">
								<label for="none" class="col-md-3 control-label">&nbsp;</label>
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<div class="icheck-turquoise">
										<input type="checkbox" id="cb_gdpr2" name="cb_gdpr2"<?php if(isset($message->cb_gdpr2) && $message->cb_gdpr2==1){echo " checked";} ?> />
										<label for="cb_gdpr2">* Adatkezelési szabályzatot elfogadom</label>
									</div>						
									<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#gdprModal" style="float: right;">
										Adatkezelési szabályzat elolvasása
									</button>
								</div>
							</div>
							
<?php
	//debug($message); die();
?>								

							<div class="form-group">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
									<div class="icheck-turquoise">
									</div>						
								</div>
							</div>
						</div><!-- /.box-body -->

						<div class="form-group">
							<label for="group_id" class="col-sm-12 control-label" style="text-align: center;">Biztonsági kód:</label>
							<div class="col-sm-10" style="font-family: Consolas, Menlo, Monaco, 'Lucida Console', 'Liberation Mono', 'DejaVu Sans Mono', 'Bitstream Vera Sans Mono', 'Courier New', monospace, serif; font-size: 12px; border: 1px solid red; width: 100%; line-height: 5px; padding: 10px; text-align: center; font-size: 10px; letter-spacing: -1px; background: red;">
								<?= $captcha ?>
							</div>
						</div>            

						<div class="form-group">
							<label for="group_id" class="col-sm-12" style="color: red;">Írja be a fentebb olvasható biztonsági a kódot:</label>
							<div class="col-sm-12">
								<?php echo $this->Form->input('captcha', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'border: 1px solid red;' ]); ?>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12 text-center">
								<?= $this->Form->button('<i class="fa fa-fw fa-send"></i> Üzenet küldése',['class'=>'btn btn-primary btn-lg', 'id'=>'send-message2', 'type'=>'button']) ?>
							</div>
						</div>
						<!--/div-->
					<?= $this->Form->end() ?>
					
					</div>
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
        <h4 class="modal-title" id="gdpeLabel"><?= $gdpr_title ?></h4>
      </div>
      <div class="modal-body">
        <?= $gdpr_body ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Elolvastam</button>
      </div>
    </div>
  </div>
</div>

