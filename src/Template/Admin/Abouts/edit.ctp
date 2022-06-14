
<!-- -------------------------------- FORM -------------------------------- -->
<!--div class="box">
	<div class="box-body">
		<?= $this->Form->postLink(
				__('<button type="button" class="btn btn-danger">Töröl</button>'),
				['action' => 'delete', $about->id],
				['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $about->id)]
			)
		?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

	</div>
</div-->

<div class="box box-info">
	<div class="box-header with-border">
		<div class="col-sm-10">
			<h3 class="box-title"><?= __('Módosítás') ?></h3>
		</div>
	</div>
	<?= $this->Form->create($about,['class'=>'form-horizontal']) ?>



		<div class="col-md-10">
		  <!-- Custom Tabs -->
		  <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a aria-expanded="true" href="#tab_contact" data-toggle="tab">Kapcsolat oldal adatai</a></li>
			  <li class=""><a aria-expanded="false" href="#tab_bottom" data-toggle="tab">Alsó sáv</a></li>
			  <li class=""><a aria-expanded="false" href="#tab_footer" data-toggle="tab">Lábléc</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_contact">
					<h3>Kapcsolat oldal adatai</h3>

					<div class="box-body">
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">Név:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">Cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">Email:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">Telefon:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">Fax:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('fax', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
					</div><!-- /.box-body -->


			  </div>
			  <!-- /.tab-pane -->
			  <div class="tab-pane" id="tab_bottom">
				<h3>Alsó sáv</h3>

					<div class="box-body">
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">1. ikon:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('icon1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">1. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('title1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">1. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('text1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">2. ikon:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('icon2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">2. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('title2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">2. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('text2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">3. ikon:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('icon3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">3. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('title3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">3. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('text3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">4. ikon:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('icon4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">4. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('title4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">4. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('text4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

					</div>

			  </div><!-- /.tab-pane -->
			  <div class="tab-pane" id="tab_footer">
				<h3>Lábléc</h3>


					<div class="box-body">
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">1. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_title1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">1. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_text1', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>
          
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">2. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_title2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">2. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_text2', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>
          
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">3. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_title3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">3. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_text3', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">4. cím:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_title4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>            
						<div class="form-group">
							<label for="group_id" class="col-sm-1 control-label">4. szöveg:</label>
							<div class="col-sm-10">
								<?php echo $this->Form->input('footer_text4', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
							</div>
						</div>

					</div>



			  </div><!-- /.tab-alapadatok -->
			</div><!-- /.tab-alsó sáv -->
		  </div><!-- nav-lábléc -->

		</div>
























		<div class="box-footer">
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
				<a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/abouts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
			</div>
		</div><!-- /.box-footer -->

	<?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
