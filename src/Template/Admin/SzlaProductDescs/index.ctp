<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/productDescs/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
			<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?><br>
			www publikus név: <span style="color: green;">Zöld megjelenik a weben,</span> <span style="color: red;">a piros nem listázódik</span>

		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
<?php /*
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_productDescs', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="productDescs_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="productDescs" role="grid" id="productDescs" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('net_without_tv_id','netId') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 100px; text-align: left; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('headstation_id','Fejállomás') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Rang') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 220px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','www publikus neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 100px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('variable','Variable') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 350px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('contents','Tartalom') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('Individual','Egyéni') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('startstate','Sate') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('to_price','Árhoz') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 88px; text-align: center; border-left: 2px solid green;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Termék ID</th>
									<th style="border-bottom: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Termék neve</th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('SzlaProducts.csoport','Csoport') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($productDescs as $productDesc): ?> 
								<tr row-id="<?= $productDesc->id ?>">
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($productDesc->id) ?></td>
									<td style="text-align: center; padding-left: 7px; font-weight: bold;<?php if($productDesc->net_without_tv_id > 0){ echo "color: #000; background: #cfc; "; }else{ echo "color: #ccc;";} ?>"><?= h($productDesc->net_without_tv_id) ?></td>

									<td style="text-align: left; padding-right: 7px;"><?= $productDesc->szla_headstation->name ?></td>
									<td style="text-align: center; padding-left: 7px; font-weight: bold;"><?= h($productDesc->pos) ?></td>
									<td style="text-align: left; padding-left: 7px; font-weight: bold;<?php if($productDesc->visible==0){ echo "background: #fcc;"; }else{ echo "background: #cfc;";} ?>"><?= h($productDesc->name) ?></td>
									<td style="text-align: center; padding-left: 7px; font-weight: normal;"><?= h($productDesc->variable) ?></td>
									<td style="text-align: left; padding-left: 7px; font-weight: normal;"><?= h($productDesc->contents) ?></td>
									<td style="text-align: center; padding-right: 7px; font-weight: bold; border-left: 2px solid green;"><?= $productDesc->individual ?></td>
									<td style="text-align: center; padding-right: 7px; font-weight: bold;"><?= $productDesc->startstate ?></td>
									<td style="text-align: center; padding-right: 7px; font-weight: bold;">
										<?php if($productDesc->to_price>0){ echo $productDesc->to_price; } ?>
									<?php //= $productDesc->to_price ?></td>
									<td style="text-align: center; padding-right: 7px; border-left: 2px solid green;"><?= $productDesc->szla_product->id ?></td>
									<td style="text-align: left; padding-right: 7px; "><?= $productDesc->szla_product->nev ?></td>
									<td style="text-align: center; padding-right: 7px; font-weight: bold;"><?= $productDesc->szla_product->csoport ?></td>
									<td style="text-align: center; border-left: 2px solid green;"><?= $this->Time->format( $productDesc->modified, 'yyyy.MM.dd. HH:mm:ss', null, $productDesc->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $productDesc->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $productDesc->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $productDesc->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $productDesc->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('net_without_tv_id','netId') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('headstation_id','Fejállomás') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Sor') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','www publikus neve') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('variable','Variable') ?></th>
									<th style="border-top: 2px solid lightgray; width: 220px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('contents','Tartalom') ?></th>
									<th style="border-top: 2px solid lightgray; width: 80px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Egyéni</th>
									<th style="border-top: 2px solid lightgray; width: 80px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Sate</th>
									<th style="border-top: 2px solid lightgray; width: 80px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Árhoz</th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Termék ID</th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Termék neve</th>
									<th style="border-top: 2px solid lightgray; width: 80px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting">Csoport</th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="productDescs" tabindex="0">Műveletek</th>
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

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
<?php /*
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_productDescs', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>



<!-- ------------------------------------------------- /index ------------------------------------------------- -->
