<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/postcategories/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Cikkek</button>'), ['controller' => 'Posts', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új cikk</button>'), ['controller' => 'Posts', 'action' => 'add'], ['escape' => false]) ?>
		</div>
<?php /*
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_postcategories', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>
*/ ?>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="postcategories_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="postcategories" role="grid" id="postcategories" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="postcategories" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 60px;">Kép</th>
									<th style="border-bottom: 2px solid lightgray;" aria-label="" aria-controls="postcategories" tabindex="0" class="sorting"><?= $this->Paginator->sort('title','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center;" aria-label="" aria-controls="postcategories" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Rang.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="postcategories" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="postcategories" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="postcategories" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($postcategories as $postcategory): ?> 
								<tr row-id="<?= $postcategory->id ?>">
									<td style="vertical-align: middle; text-align: right; padding-right: 7px;"><?= $this->Number->format($postcategory->id) ?></td>
									<td style="vertical-align: middle; text-align: left; padding-left: 7px;"><img src="/images/uploads/postcategories/<?= h($postcategory->id) ?>_thumb.jpg" height="40" /></td>
									<td style="vertical-align: middle; text-align: left; padding-left: 7px; font-weight: bold;"><?= h($postcategory->title) ?></td>
									<td style="vertical-align: middle; text-align: center; padding-left: 7px; font-weight: bold;"><?= h($postcategory->pos) ?></td>
									<td style="vertical-align: middle; text-align: center;"><?= $this->Time->format( $postcategory->created, 'yyyy.MM.dd. HH:mm:ss', null, $postcategory->time_zone ); ?></td>
									<td style="vertical-align: middle; text-align: center;"><?= $this->Time->format( $postcategory->modified, 'yyyy.MM.dd. HH:mm:ss', null, $postcategory->time_zone ); ?></td>
									<td style="vertical-align: middle; text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $postcategory->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $postcategory->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $postcategory->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $postcategory->id)]) ?>
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
