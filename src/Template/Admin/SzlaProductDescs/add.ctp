
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
	<div class="box-body">
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

	</div>
</div>

<div class="box box-info">
	<div class="box-header with-border">
		<div class="box-header">
		</div>

		<div class="col-sm-1">
			&nbsp;
		</div>
		<div class="col-sm-10">
			<h3 class="box-title"><?= __('Új felvitele') ?></h3>
		</div>
	</div>
	<?= $this->Form->create($productDesc,['class'=>'form-horizontal']) ?>
		<div class="box-body">
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Típus:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('type', ['options'=>$type, 'default'=>'termék', 'label'=>false, 'type'=>'select', 'class'=>'form-control selectpicker', 'title'=>'Válassz típust', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>

<?php /*
		   <div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Csoport:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('servicegroup', [
						'options'=> $itemgroups,

//						[
//							1=>'1. Kábel Televízió hűség idővel',
//							2=>'2. Internet szolgáltatás díja Televízió szolgáltatás mellé',
//							3=>'3. Internet szolgáltatás díja Televízió szolgáltatás nélkül',
//							4=>'4. Csomag árak',
//							5=>'5. Telefon szolgáltatás nem lebeszélhető havidíjjal',
//							6=>'6. Korlátlan belföldi vezetékes díjcsomag',
//							7=>'7. Csomagárak lebeszélhető havidíjas telefonszolgáltatással',
//						],

						'type'=>'select',
						'label'=>false, 'class'=>'form-control selectpicker', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>
*/ ?>

			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Fejállomás:</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('headstation_id', ['label'=>false, 'class'=>'form-control selectpicker', 'title'=>'Válassz fejállomást', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Termék:</label>
				<div class="col-sm-4">
					<?php echo $this->Form->input('product_id', ['label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Válassz terméket', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 5px;">
					<p>&larr; Termék törzsben melyik termékhez kapcsolódik.</p>
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">NET fő id:</label>
				<div class="col-sm-4">
					<?php echo $this->Form->input('net_without_tv_id', ['label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>'true', 'title'=>'Válassz terméket', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-6" style="padding-top: 5px;">
					<p>&larr; NET descs->id. Ha nem kérnek TV-t a net-hez és ha itt érték van, akkor ez az ID alapján kerül az ár lekérésre.</p>
				</div>
			</div>            
			
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Sor:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('pos', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false, 'value'=>1]); ?>
				</div>
				<div class="col-sm-9" style="padding-top: 5px;">
					<p>&larr; Sorrendet befolyásoló szám. Rang.</p>
				</div>
			</div>
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Neve:</label>
				<div class="col-sm-3">
					<?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-7" style="padding-top: 5px;">
					<p>&larr; Ez a név jelenik meg a web-en</p>
				</div>
			</div>            
			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Rövid tartalom:</label>
				<div class="col-sm-10">
					<?php echo $this->Form->input('contents', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>

			<div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Látható:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('visible', ['type'=>'checkbox', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-9" style="padding-top: 10px;">
					<p>&larr; Megjelenjen a (Kábel TV, Internet, Telefon)... menüpontok alatt a listázásnál vagy sem.</p>
				</div>
			</div>
			<div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Ár számításhoz:</label>
				<div class="col-sm-3">
					<?php echo $this->Form->input('to_price', ['options'=> $to_price, 'type'=>'select', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-7" style="padding-top: 10px;">
					<p>&larr; Ár számáításnál EZT az akciós csomagot vegye figyelembe! (Digi csomagoknál az xXx licenc díj hozzáadás miatt jelöld be!)</p>
				</div>
			</div>
			<div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Licenc díj (xXx):</label>
				<div class="col-sm-2">
					<?php echo $this->Form->input('licenc_price', ['type'=>'number', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Kártya licenc díja', 'autofocus'=>false, 'disabled'=>false, 'value'=>0 ]); ?>
				</div>
				<div class="col-sm-8" style="padding-top: 10px;">
					<p>&larr; Kártya licenc díj (felnőtt csomaghoz)! Kérlek jelöld be az Ár számításhoz pipát</p>
				</div>
			</div>
			<!--div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Csom.látható:</label>
				<div class="col-sm-10">
					<?php //echo $this->Form->input('visible_package', ['type'=>'checkbox', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div-->

			<div class="form-group">
				<label for="group_id" class="col-sm-1 control-label">Bővebb tartalom:</label>
				<div class="col-sm-10">
					<?php echo $this->Form->input('description', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
			</div>    

			<h2>Egyéni csomagösszeálíltás</h2>
			<div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Látható:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('individual', ['type'=>'checkbox', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-9" style="padding-top: 5px;">
					<p>&larr; Látható legyen az egyéni csomagösszeállításnál</p>
				</div>
			</div>
			<div class="form-group">
				<label for="visible" class="col-sm-1 control-label">Induló állapot:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('startstate', ['type'=>'checkbox', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-9" style="padding-top: 5px;">
					<p>&larr; Kapcsolók kezdeti beállítása. (Disabled) Tiltott=0, (Enabled) engedélyezett=1</p>
				</div>
			</div>
			<div class="form-group">
				<label for="startstate" class="col-sm-1 control-label">Digi csom.-hoz:</label>
				<div class="col-sm-1">
					<?php echo $this->Form->input('catv_for_digi', ['type'=>'checkbox', 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Csomag esetén az alsó szerkeszőben írd le a tartalmat', 'autofocus'=>false, 'disabled'=>false ]); ?>
				</div>
				<div class="col-sm-9" style="padding-top: 5px;">
					<p><b>Havi előfizetési díj ellenében nézhető digitális csomagokhoz</b>:</p>
					<p>- Bólyi fejállomásnál azt kell bekapcsolni, amelyik szükséges a digi csomagok nézéséhez. Ez pl a KTV Bővített</p>
					<p>- FIVAN fejállomásnál azt kell bekapcsolni, amelyikhez szükséges telefon és vagy Internet a KTV mellé. Ez pl a KTV Mini</p>
				</div>
			</div>
		</div><!-- /.box-body -->

		<div class="box-footer">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
				<a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/szla_product_descs/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
			</div>
		</div><!-- /.box-footer -->

	<?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
