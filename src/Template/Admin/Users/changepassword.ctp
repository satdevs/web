<div class="login-box">
	<div class="login-logo">
		<img src="/img/logo.png" alt="Sághy-Sat Kft." style="float: left; height: 60px; margin-right: -65px;">
		<a href="/" style="color: #0053A0;"><b>Sághy</b>-Sat</a>
	</div>
	<div class="login-box-body"><!-- /.login-logo -->
		<p class="login-box-msg">Jelszó módosítása</p>
		<?= $this->Form->create() ?>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password_old',['class'=>'form-control', 'type'=>'password', 'placeholder'=>'Régi jelszó', 'label'=>'Régi jelszó', 'div'=>false, 'autofocus'=>true]) ?>
				<!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password_new',['class'=>'form-control', 'type'=>'password', 'placeholder'=>'Új jelszó', 'label'=>'Új jelszó', 'div'=>false, 'autofocus'=>true]) ?>
				<!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password_confirm',['class'=>'form-control', 'type'=>'password', 'placeholder'=>'Új jelszó ismét', 'label'=>'Új jelszó ismét', 'div'=>false]) ?>
				<!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
			</div>
			<div class="row">
<?php if(isset($captchaHTML)){ ?>
				<div class="col-xs-12" style="background: #0053A0; color:#ccc; margin-bottom: 10px; padding-top: 10px; padding-bottom: 10px; overflow: hidden;">
					<div id="captcha" style="font-size: 6px; line-height: 4px; letter-spacing: -1px; font-weight: bold; font-family: Courier;">
						<?= $captchaHTML ?>
					</div>
				</div>
<?php } ?>
				<!--div class="col-xs-12">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox"> Emlékezz rám (később)
						</label>
					</div>
				</div--><!-- /.col -->
				<div class="col-xs-6">
					<?= $this->Form->button(__('Jelszó módosítása'), ['class'=>'btn btn-primary btn-block btn-flat']); ?>
				</div><!-- /.col -->
				<div class="col-xs-6">
					&nbsp;
				</div><!-- /.col -->
			</div>
		<?= $this->Form->end() ?>
		
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->
