<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/pdfinvoices/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<?php /*
<div class="box">
	<div class="box-body">
		<div class="col-sm-10">
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_pdfinvoices', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>

	</div>
</div>
*/ ?>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="pdfinvoices_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="pdfinvoices" role="grid" id="pdfinvoices" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">Állapot</th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('sub_id','ID') ?></th>
									<th style="border-bottom: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('name','Név') ?><br>
										<?= $this->Paginator->sort('email','Email') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('city','Település') ?><br>
										<?= $this->Paginator->sort('address','Cím') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray; text-align: left;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone','Telefon') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: left;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('type','Tipus') ?><br>
										<?= $this->Paginator->sort('taxnumber','Adószám') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray; width: 155px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('activated','Aktiválva') ?><br>
										<?= $this->Paginator->sort('deactivated','Deaktiválva') ?>
									</th>

									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 30px;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb1','1') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 30px;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb2','2') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 30px;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb3','3') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 30px;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb4','4') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 30px;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb5','5') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; width: 160px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('processed_activate','Feldolgozva BE') ?><br>
										<?= $this->Paginator->sort('processed_deactivate','Feldolgozva KI') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('created','Készült') ?><br>
										<?= $this->Paginator->sort('modified','Módosítva') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($pdfinvoices as $pdfinvoice): ?>
								<tr row-id="<?= $pdfinvoice->id ?>">
									<td style="text-align: center; padding-left: 7px; vertical-align: middle;">
										<?php if($pdfinvoice->activated === Null){ ?>
										<span class="glyphicon glyphicon-question-sign" aria-hidden="true" style="color: gray; font-size: 18px;" title="Új igény, még nem aktivált"></span>
										<?php } ?>
										<?php if($pdfinvoice->activated !== Null && $pdfinvoice->deactivated === Null){ ?>
										<span class="glyphicon glyphicon-ok-sign" aria-hidden="true" style="color: green; font-size: 32px;" title="Új igény, AKTIVÁLT"></span>
										<?php } ?>
										<?php if($pdfinvoice->deactivated !== Null){ ?>
										<span class="glyphicon glyphicon-minus-sign" aria-hidden="true" style="color: red; font-size: 18px;" title="Tötölt igény, DEAKTIVÁLT"></span>
										<?php } ?>
									</td>

									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-size: 16px; font-weight: bold;"><?= h($pdfinvoice->sub_id) ?></td>

									<td style="text-align: left; padding-left: 7px;">
										<b><?= h($pdfinvoice->name) ?></b><br>
										<?= h($pdfinvoice->email) ?>
									</td>

									<td style="text-align: left; padding-left: 7px;">
										<b><?= h($pdfinvoice->city) ?></b><br>
										<?= h($pdfinvoice->address) ?>
									</td>

									<td style="text-align: left; padding-left: 7px; vertical-align: middle;"><?= h($pdfinvoice->phone) ?></td>
									<td style="text-align: left; padding-left: 7px;">
										<?= h($pdfinvoice->type) ?><br>
										<?= h($pdfinvoice->taxnumber) ?>
									</td>
									<td style="text-align: center;">
										<span style="font-weight: bold; color: green;"><?= $this->Time->format( $pdfinvoice->activated, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone ); ?></span><br>
										<span style="font-weight: bold; color: red;"><?= $this->Time->format( $pdfinvoice->deactivated, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone ); ?></span>
									</td>


									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-weight: bold; font-family: Arial; border-right: 1px solid lightgray;">
										<?php if(h($pdfinvoice->cb1)){echo "X";} ?>
									</td>
									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-weight: bold; font-family: Arial; border-right: 1px solid lightgray;">
										<?php if(h($pdfinvoice->cb2)){echo "X";} ?>
									</td>
									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-weight: bold; font-family: Arial; border-right: 1px solid lightgray;">
										<?php if(h($pdfinvoice->cb3)){echo "X";} ?>
									</td>
									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-weight: bold; font-family: Arial; border-right: 1px solid lightgray;">
										<?php if(h($pdfinvoice->cb4)){echo "X";} ?>
									</td>
									<td style="text-align: center; padding-left: 7px; vertical-align: middle; font-weight: bold; font-family: Arial; border-right: 1px solid lightgray;">
										<?php if(h($pdfinvoice->cb5)){echo "X";} ?>
									</td>

									<td style="text-align: center; padding-left: 7px; border-right: 1px solid lightgray; vertical-align: middle;">
										<b><?php
											if($pdfinvoice->processed_activate == Null){
												echo "Új";
											}
											if($pdfinvoice->processed_activate !== Null){
												echo '<span style="color: green;">';
												echo $this->Time->format( $pdfinvoice->processed_activate, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone );
												echo '</span><br>';
											}
											if($pdfinvoice->processed_deactivate !== Null){
												echo '<span style="color: red;">';
												echo $this->Time->format( $pdfinvoice->processed_deactivate, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone );
												echo '</span>';
											}
										?></b><br>
									</td>

									<td style="text-align: center;">
										<?= $this->Time->format( $pdfinvoice->created, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone ); ?><br>
										<?= $this->Time->format( $pdfinvoice->modified, 'yyyy.MM.dd. HH:mm:ss', null, $pdfinvoice->time_zone ); ?>
									</td>
									<td style="text-align: center; vertical-align: middle;">
										<?php //= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $pdfinvoice->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?php //= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $pdfinvoice->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 24px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $pdfinvoice->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $pdfinvoice->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">Állapot</th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('sub_id','ID') ?></th>
									<th style="border-top: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('name','Név') ?><br>
										<?= $this->Paginator->sort('email','Email') ?>
									</th>
									<th style="border-top: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('city','Település') ?><br>
										<?= $this->Paginator->sort('address','Cím') ?>
									</th>
									<th style="border-top: 2px solid lightgray; text-align: left;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone','Telefon') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: left;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('type','Tipus') ?><br>
										<?= $this->Paginator->sort('taxnumber','Adószám') ?>
									</th>
									<th style="border-top: 2px solid lightgray; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('activated','Aktiválva') ?><br>
										<?= $this->Paginator->sort('deactivated','Deaktiválva') ?>
									</th>

									<th style="border-top: 2px solid lightgray; text-align: center;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb1','1') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb2','2') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb3','3') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb4','4') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb5','5') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('processed_activates','Feldolgozva BE') ?><br>
										<?= $this->Paginator->sort('processed_deactivates','Feldolgozva KI') ?>
									</th>
									<th style="border-top: 2px solid lightgray; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('created','Készült') ?><br>
										<?= $this->Paginator->sort('modified','Módosítva') ?>
									</th>
									<th style="border-top: 2px solid lightgray; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="pdfinvoices" tabindex="0">Műveletek</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>

<?= $this->element('paginator'); ?>

		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- ------------------------------------------------- /index ------------------------------------------------- -->
