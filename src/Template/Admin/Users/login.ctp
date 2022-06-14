<div class="login-box">
	<div class="login-logo">
		<img src="/img/logo.png" alt="Sághy-Sat Kft." style="float: left; height: 60px; margin-right: -65px;">
		<a href="/" style="color: #0053A0;"><b>Sághy</b>-Sat</a>
	</div>
	<div class="login-box-body"><!-- /.login-logo -->
		<p class="login-box-msg">Bejelentkezés</p>
		<?= $this->Form->create() ?>
			<div class="form-group has-feedback">
				<?= $this->Form->input('email',['class'=>'form-control', 'placeholder'=>'Email', 'label'=>'Email', 'div'=>false, 'autofocus'=>true]) ?>
				<!--span class="glyphicon glyphicon-envelope form-control-feedback"></span-->
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password',['class'=>'form-control', 'placeholder'=>'Jelszó', 'label'=>'Jelszó', 'div'=>false]) ?>
				<!--span class="glyphicon glyphicon-lock form-control-feedback"></span-->
			</div>
			<div class="row">
				<!--div class="col-xs-12">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox"> Emlékezz rám (később)
						</label>
					</div>
				</div--><!-- /.col -->
				<div class="col-xs-6">
					<?= $this->Form->button(__('Bejelentkezés'), ['class'=>'btn btn-primary btn-block btn-flat']); ?>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-warning btn-block btn-flat" href="/admin/elfelejtett-jelszo.html">Elfelejtett jelszó</a>
				</div><!-- /.col -->
			</div>
		<?= $this->Form->end() ?>
		
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->
