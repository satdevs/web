<?php
	$services = [0=>'---', 1=>'Kábel TV', 2=>'Internet'];
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/dependencies/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_dependencies', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="dependencies_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="dependencies" role="grid" id="dependencies" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 20%; " aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel_id','') ?></th>
									<th style="text-align: center; border-bottom: 2px solid lightgray; width: 10%; " aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0" class="sorting"><?= $this->Paginator->sort('catv_id','') ?></th>
									<th style="text-align: center; border-bottom: 2px solid lightgray; width: 10%; " aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0" class="sorting"><?= $this->Paginator->sort('net_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0" class="sorting">&nbsp;</th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dependencies" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($dependencies as $dependency): ?> 
								<tr row-id="<?= $dependency->id ?>">
									<td style="text-align: right; padding-center: 7px;"><?= $this->Number->format($dependency->id) ?></td>
									<!--td style="text-align: left; padding-left: 7px;"><?= h($dependency->name) ?></td-->
									<td style="text-align: left; padding-left: 7px;">
										<?php
										if(isset($dependency->tel->name)){
											echo h($dependency->tel->name);
										}else{
											echo '---';
										}
										?>
									</td>
									<td style="text-align: center; padding-left: 7px;">
										<?php
											echo $dependency->catv_id;
										?>
									</td>
									<td style="text-align: center; padding-left: 7px;">
										<?php
											echo $dependency->net_id;
										?>
									</td>
									<td style="text-align: left; padding-left: 7px;">
										&nbsp;
									</td>

									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $dependency->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $dependency->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $dependency->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $dependency->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>

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
