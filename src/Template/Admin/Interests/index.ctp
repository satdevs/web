<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/interests/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Interestdetails</button>'), ['controller' => 'Interestdetails', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Interestdetail</button>'), ['controller' => 'Interestdetails', 'action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
<?php /*
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_interests', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
			<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Függőben lévők</button>'), ['controller' => 'Interests', 'action' => 'index','pending'], ['escape' => false]) ?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Érdeklődők</button>'), ['controller' => 'Interests', 'action' => 'index','sent'], ['escape' => false]) ?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Felhívottak</button>'), ['controller' => 'Interests', 'action' => 'index','commited'], ['escape' => false]) ?>
		</div>
	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="interests_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="interests" role="grid" id="interests" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('status','Állapot') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('city','Város') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('address','Cím') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone','Tel.') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('email','Email') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('package_name','Csomag') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_services','Szolg.ár.') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_digitals','Digi') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_total','Összesen') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($interests as $interest): ?> 
								<tr row-id="<?= $interest->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($interest->id) ?></td>
									<td style="text-align: center; padding-left: 7px; font-size: 18px; font-weight: bold;">
										<?php if($interest->status <= 1){ ?>
											<span title="Státusz = 0 v. 1" style="color: gray;" class="glyphicon glyphicon-pencil"></span>
										<?php } ?>
										<?php if($interest->status == 2){ ?>
											<a href="/admin/interests/view/<?= $interest->id ?>">
												<span title="Státusz = 2" style="color: green;" class="glyphicon glyphicon-envelope"></span>
											</a>
										<?php } ?>
										<?php if($interest->status == 3){ ?>
											<a href="/admin/interests/view/<?= $interest->id ?>">
												<span title="Státusz = 3" style="color: blue;" class="glyphicon glyphicon-ok"></span>
											</a>
										<?php } ?>
									</td>

									<td style="text-align: left; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->name) ?></td>
									<td style="text-align: left; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->city) ?></td>
									<td style="text-align: left; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->address) ?></td>
									<td style="text-align: left; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->phone) ?></td>
									<td style="text-align: left; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->email) ?></td>

									<td style="text-align: center; padding-left: 7px; font-size: 18px; font-weight: bold;"><?= h($interest->package_name) ?></td>
									<td style="text-align: right; padding-right: 7px; font-size: 18px; font-weight: bold;"><?= $this->Number->format($interest->price_services,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>									
									<td style="text-align: right; padding-right: 7px; font-size: 18px; font-weight: bold;"><?= $this->Number->format($interest->price_digitals,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>									
									<td style="text-align: right; padding-right: 7px; font-size: 18px; font-weight: bold;"><?= $this->Number->format($interest->price_total,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>									

									<td style="text-align: center;"><?= $this->Time->format( $interest->modified, 'yyyy.MM.dd. HH:mm:ss', null, $interest->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $interest->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $interest->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $interest->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $interest->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('status','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('city','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('address','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('email','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('package_name','') ?></th>

									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_services','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_digitals','') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('price_total','') ?></th>

									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="interests" tabindex="0">Műveletek</th>
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
