<?= $this->Flash->render() ?>
<?= $this->Flash->render('auth') ?>
<div class="login-box">
	<div class="login-logo">
		<img src="/img/logo.png" alt="Sághy-Sat Kft." style="float: left; height: 60px; margin-right: -65px;">
		<a href="/" style="color: #0053A0;"><b>Sághy</b>-Sat</a>
	</div>
	<div class="login-box-body"><!-- /.login-logo -->
		<p class="login-box-msg">Bejelentkezés</p>
		<?= $this->Form->create() ?>
			<div class="form-group has-feedback">
				<?= $this->Form->input('email',['class'=>'form-control', 'placeholder'=>'Email', 'label'=>'Email címed', 'div'=>false, 'autofocus'=>true]) ?>
				<!--span class="glyphicon glyphicon-envelope form-control-feedback"></span-->
			</div>
			<div class="form-group has-feedback">
				<?= $this->Form->input('password',['class'=>'form-control', 'placeholder'=>'Jelszó', 'label'=>'Jelszavad', 'div'=>false]) ?>
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
					<?= $this->Form->button(__('Elfelejtett jelszó'), ['class'=>'btn btn-warning btn-block btn-flat']); ?>
				</div><!-- /.col -->
				<div class="col-xs-6">
					<?= $this->Form->button(__('Bejelentkezés'), ['class'=>'btn btn-primary btn-block btn-flat']); ?>
				</div><!-- /.col -->
			</div>
		<?= $this->Form->end() ?>
		<!--div class="social-auth-links text-center">
			<p>- OR -</p>
			<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
			Facebook</a>
			<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
			Google+</a>
		</div--><!-- /.social-auth-links -->
		<a href="/elfelejtett-jelszo.html">Elfelejtettem a jelszavam</a><br>
		<a href="/regisztracio.html" class="text-center">Regisztráció</a>
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->
