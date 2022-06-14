				<div class="widget webmail hidden-sm hidden-xs">
					<div class="box box-info">
						<div class="box-header with-border col-sm-12">
							<h3 class="box-title text-center"><?= __('Webmail belépés') ?></h3>
						</div>
						<div class="box-body">
							<form method="post" action="https://webmail2.saghysat.hu/?_task=mail">

								<div class="input-group">
									<label for="rcmloginuser" class="control-label">Email:</label>
									<input name="_user" title="Email" id="rcmloginuser" type="text" class="form-control" autocomplete="off" placeholder="Email" style="width: 100%;">
									<span class="input-group-btn"></span>
								</div>
								<br>
								<div class="input-group">
									<label for="rcmloginpwd" class="control-label">Jelszó:</label>
									<input name="_pass" title="Jelszó" id="rcmloginpwd" type="password" class="form-control" autocomplete="off" placeholder="Jelszó" style="width: 100%;">
									<span class="input-group-btn"></span>
								</div>
								<br>
								<div class="input-group">
									<input value="Belépés" id="mailsubmit" type="submit" class="btn btn-default" style="width: 100%;">
									<input value="login" name="_action" type="hidden">
									<input value="webmail2.saghysat.hu" name="_host" type="hidden">
								</div>
							</form>
						</div>
					</div>
				</div><!--/.webmail-->
				<img src="/images/shadow.png" class="hidden-sm hidden-xs" style="height: 20px; width:100%; margin-bottom: 20px;" />
