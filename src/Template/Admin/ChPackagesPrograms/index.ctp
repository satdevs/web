<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/packagesPrograms/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-2">	
			<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-10">	
			<?php if($active=="analog-1"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'">Bóly analóg</button>'), ['action' => 'index','analog',1], ['escape' => false]) ?>
			<?php if($active=="digitalis-1"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Bóly digitális</button>'), ['action' => 'index','digitalis',1], ['escape' => false]) ?>
			<?php if($active=="analog-2"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Felsőszentiván analóg</button>'), ['action' => 'index','analog',2], ['escape' => false]) ?>
			<?php if($active=="digitalis-2"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Felsőszentiván digitális</button>'), ['action' => 'index','digitalis',2], ['escape' => false]) ?>
			<?php if($active=="analog-3"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Udvar analóg</button>'), ['action' => 'index','analog',3], ['escape' => false]) ?>
			<?php if($active=="analog-4"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Homorúd analóg</button>'), ['action' => 'index','analog',4], ['escape' => false]) ?>
			<?php if($active=="analog-5"){$btn = "warning";}else{$btn = "info";}?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-'.$btn.'"">Újmohács analóg</button>'), ['action' => 'index','analog',5], ['escape' => false]) ?>

		</div>
<?php /*
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_packagesPrograms', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>
*/ ?>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="packagesPrograms_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="packagesPrograms" role="grid" id="packagesPrograms" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 30px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('packageorder','Rang') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 250px;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('package_id','Csomag') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('lcn','LCN') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 210px; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('program_id','Műsor') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px;text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('broadcast','Terjesztés') ?></th>
<?php if(substr($active,0,3)=='ana'){ ?>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('band_id','Band') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px;text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('frequency','Fr.') ?></th>
<?php } ?>
<?php if(substr($active,0,3)=='dig'){ ?>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('qam','QAM') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('sid','SID') ?></th>
<?php } ?>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($packagesPrograms as $packagesProgram): ?> 
								<tr row-id="<?= $packagesProgram->id ?>">
									<td style="text-align: center; padding-right: 7px; border-left: 2px solid lightgray;border-right: 2px solid lightgray; "><?= $this->Number->format($packagesProgram->id) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($packagesProgram->packageorder) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= h($packagesProgram->ch_package->name) ?></td>
									<td style="text-align: center; padding-right: 7px;border-left: 2px solid lightgray; "><?= $this->Number->format($packagesProgram->lcn) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= $packagesProgram->ch_program->name ?></td>
									<td style="text-align: center; padding-left: 7px;"><?= h($packagesProgram->broadcast) ?></td>
	<?php if($packagesProgram->broadcast == "Analóg"){ ?>
									<td style="text-align: center; padding-left: 7px;border-left: 2px solid lightgray;"><?= h($packagesProgram->band_id) ?></td>
									<td style="text-align: center; padding-right: 7px;border-right: 2px solid lightgray;"><?= $this->Number->format($packagesProgram->frequency) ?></td>
	<?php } ?>
	<?php if($packagesProgram->broadcast == "Digitális"){ ?>
									<td style="text-align: center; padding-left: 7px;border-left: 2px solid lightgray;"><?= h($packagesProgram->qam) ?></td>
									<td style="text-align: center; padding-right: 7px;border-right: 2px solid lightgray;"><?= $this->Number->format($packagesProgram->sid) ?></td>
	<?php } ?>									
									<td style="text-align: center;"><?= $this->Time->format( $packagesProgram->modified, 'yyyy.MM.dd. HH:mm:ss', null, $packagesProgram->time_zone ); ?></td>
									<td style="text-align: center;border-left: 2px solid lightgray;border-right: 2px solid lightgray; ">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $packagesProgram->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $packagesProgram->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $packagesProgram->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $packagesProgram->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('packageorder','Rang') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('package_id','Csomag') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('lcn','LCN') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('program_id','Műsor') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('broadcast','Terjesztés') ?></th>
<?php if(substr($active,0,3)=='ana'){ ?>
									<th style="border-top: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('band_id','Band') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('frequency','Fr.') ?></th>
<?php } ?>
<?php if(substr($active,0,3)=='dig'){ ?>
									<th style="border-top: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('qam','QAM') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('sid','SID') ?></th>
<?php } ?>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="packagesPrograms" tabindex="0">Műveletek</th>
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
