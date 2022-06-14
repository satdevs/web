<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/interestdetails/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Interests</button>'), ['controller' => 'Interests', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Interest</button>'), ['controller' => 'Interests', 'action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_interestdetails', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="interestdetails_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="interestdetails" role="grid" id="interestdetails" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('interest_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('productdesc_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('price','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_name','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_group','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($interestdetails as $interestdetail): ?> 
								<tr row-id="<?= $interestdetail->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interestdetail->id) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= $interestdetail->has('interest') ? $this->Html->link($interestdetail->interest->name, ['controller' => 'Interests', 'action' => 'view', $interestdetail->interest->id]) : '' ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interestdetail->productdesc_id) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interestdetail->product_id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($interestdetail->name) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interestdetail->price) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($interestdetail->product_name) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interestdetail->product_group) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $interestdetail->modified, 'yyyy.MM.dd. HH:mm:ss', null, $interestdetail->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $interestdetail->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $interestdetail->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $interestdetail->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $interestdetail->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('interest_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('productdesc_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('price','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_name','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('product_group','') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interestdetails" tabindex="0">Műveletek</th>
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
