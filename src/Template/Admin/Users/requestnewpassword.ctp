<div class="login-box">
	<div class="login-logo">
		<img src="/img/logo.png" alt="Sághy-Sat Kft." style="float: left; height: 60px; margin-right: -65px;">
		<a href="/" style="color: #0053A0;"><b>Sághy</b>-Sat</a>
	</div>
	<div class="login-box-body"><!-- /.login-logo -->
		<p class="login-box-msg">Új jelszó igénylése</p>
		<?= $this->Form->create() ?>
			<div class="form-group has-feedback">
				<?= $this->Form->input('email',['class'=>'form-control', 'placeholder'=>'Email', 'label'=>'Email', 'div'=>false, 'autofocus'=>true]) ?>
				<!--span class="glyphicon glyphicon-envelope form-control-feedback"></span-->
			</div>
			<div class="row">
				<div class="col-xs-6">
					<?= $this->Form->button(__('Új jelszó igénylés'), ['class'=>'btn btn-primary btn-block btn-flat']); ?>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-warning btn-block btn-flat" href="/admin/login">Bejelentkezés</a>
				</div><!-- /.col -->
			</div>
		<?= $this->Form->end() ?>
		
	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->
