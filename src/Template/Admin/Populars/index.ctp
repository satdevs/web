<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/populars/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_populars', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="populars_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="populars" role="grid" id="populars" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('catv','') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('net','') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel','') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting">&nbsp;</th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($populars as $popular): ?> 
								<tr row-id="<?= $popular->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($popular->id) ?></td>
									<td style="text-align: center; padding-right: 7px; width: 80px;"><?= $this->Number->format($popular->catv) ?></td>
									<td style="text-align: center; padding-right: 7px; width: 80px;"><?= $this->Number->format($popular->net) ?></td>
									<td style="text-align: center; padding-right: 7px; width: 80px;"><?= $this->Number->format($popular->tel) ?></td>
									<td style="text-align: right; padding-right: 7px;">&nbsp;</td>
									<td style="text-align: center;"><?= $this->Time->format( $popular->created, 'yyyy.MM.dd. HH:mm:ss', null, $popular->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $popular->modified, 'yyyy.MM.dd. HH:mm:ss', null, $popular->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $popular->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $popular->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $popular->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $popular->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('catv','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('net','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting">&nbsp;</th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="populars" tabindex="0">Műveletek</th>
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
