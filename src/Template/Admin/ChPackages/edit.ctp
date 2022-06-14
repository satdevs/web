
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
	<div class="box-body">
		<?= $this->Form->postLink(
				__('<button type="button" class="btn btn-danger">Töröl</button>'),
				['action' => 'delete', $package->id],
				['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $package->id)]
			)
		?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

	</div>
</div>

<div class="box box-info">

<?php
	//$sel = [];
	//foreach($ch_programs as $p){
	//	debug($p);
	//    $sel[] = $p->id;
	//}
	//debug($selected);

	//debug($programs);
	//$selectedPrograms = [];
	//foreach($package->ch_programs as $p){
	//    $selectedPrograms[] = $p->id;
	//}
	//foreach($package->ch_programs as $p){
	//    $selectedPrograms[] = $p->id;
	//}
	//debug($selectedPrograms);
	//debug($package);
?>



	<div class="box-header with-border">
		<div class="box-header">
		</div>

		<div class="col-sm-1">
			&nbsp;
		</div>
		<div class="col-sm-10">
			<h3 class="box-title"><?= __('Módosítás') ?></h3>
		</div>
	</div>
	<?= $this->Form->create($package,['class'=>'form-horizontal']) ?>
		<div class="box-body">
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Fejállomás:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('headstation_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Belső neve:</label>
				<div class="col-sm-7">
					<?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>            





			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Műsorok:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('ch_programs._ids', ['options'=>$ch_programs, 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>"true", 'data-actions-box'=>"true", 'autofocus'=>false, 'disabled'=>false, 'multiple'=>'multiple' ]); ?>
					
					<?php //echo $this->Form->input('ch_programs._ids', ['options'=>$programs, 'selected'=>$sel, 'style'=>'height: 300px;']); //, 'label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>"true", 'data-actions-box'=>"true", 'autofocus'=>false, 'disabled'=>false, 'multiple'=>'multiple' ]); ?>
					<?php //echo $this->Form->input('ch_programs._ids', ['options' => $ch_programs, 'style'=>'height: 400px;']); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px; color: red;">
					&nbsp;&larr; Itt óvatosan a kattintással. Ha egy műsort kiveszel, majd visszateszed, akkor újra fel kell paraméterezni!
				</div>
			</div>










			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Csomag sorrend:</label>
				<div class="col-sm-3">
					<?php echo $this->Form->input('packageorder', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Listázásnál ezt veszi figyelembe. Ez alapján csoportosít.
				</div>
			</div>    
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Terjesztés:</label>
				<div class="col-sm-3">
					<?php echo $this->Form->input('broadcast', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Egyelőre nincs használva. Jövőbeni lekérdezéseknél lehet szerepe. Töltsd ki!
				</div>
			</div>      
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Kódolás:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('encoded', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Ha üres, akkor nem kódolt
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Rövid neve:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('shortname', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Bizonyos listáknál lehet szerepe, ahol kevés a hely
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Nyilvános neve:</label>
				<div class="col-sm-4">
					<?php echo $this->Form->input('popular_name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Ügyfélnek adott listán ez jelenik meg
				</div>
			</div>   
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Nyilv.analóg komment:</label>
				<div class="col-sm-4">
					<?php echo $this->Form->input('popular_comment_analog', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Ügyfélnek adott listán ez jelenik meg
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Nyilv.digitális komment:</label>
				<div class="col-sm-4">
					<?php echo $this->Form->input('popular_comment_digital', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 6px;">
					&nbsp;&larr; Ügyfélnek adott listán ez jelenik meg
				</div>
			</div>


			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Külső ID:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('ext_id', ['type'=>'text','label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-8" style="padding-top: 6px;">
					&nbsp;&larr; Későbbi felhasználásra
				</div>
			</div>
	  
		 
			<!--div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">PackageGroup:</label>
				<div class="col-sm-4">
					<?php //echo $this->Form->input('packageGroup', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div-->            
		  
			<!--div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">External Name:</label>
				<div class="col-sm-4">
					<?php //echo $this->Form->input('external_name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div-->            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Megjegyzés:</label>
				<div class="col-sm-10">
					<?php echo $this->Form->input('comment', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>            

		</div><!-- /.box-body -->

		<div class="box-footer">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
				<a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/ch_packages/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
			</div>
		</div><!-- /.box-footer -->

	<?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
