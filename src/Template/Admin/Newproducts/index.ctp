<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/newproducts/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
			<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_newproducts', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="newproducts_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="newproducts" role="grid" id="newproducts" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_catv','KTV') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_net','NET') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_tel','TEL') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('onlyInPackage','Csom') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Név') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_catv_id','KTV') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_net_id','NET') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pkg_tel_id','TEL') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('servicegroup','Szolgáltatás') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('headstation_id','Fejállomás') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 120px; " aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('price','Ár') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Rang') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('visible','Látható') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="newproducts" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($newproducts as $newproduct): ?> 
								<tr row-id="<?= $newproduct->id ?>">
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($newproduct->id) ?></td>
									<td style="text-align: center; padding-left: 7px;">
										<?php if($newproduct->pkg_catv){echo '<i style="color: #0a0; font-size: 8px; font-weight: normal;" class="fa fa-circle" title="KTV"></i>';}else{echo '<i style="color: #faa; font-size: 8px; font-weight: normal;" class="fa fa-circle"></i>';} ?>
									</td>
									<td style="text-align: center; padding-left: 7px;" title="KTV-vel együtt">
										<?php if($newproduct->pkg_net){echo '<i style="color: #0a0; font-size: 8px; font-weight: normal;" class="fa fa-circle" title="Internet"></i>';}else{echo '<i style="color: #faa; font-size: 8px; font-weight: normal;" class="fa fa-circle"></i>';} ?>
									</td>
									<td style="text-align: center; padding-left: 7px;" title="Internettel együtt">
										<?php if($newproduct->pkg_tel){echo '<i style="color: #0a0; font-size: 8px; font-weight: normal;" class="fa fa-circle" title="Telefon"></i>';}else{echo '<i style="color: #faa; font-size: 8px; font-weight: normal;" class="fa fa-circle"></i>';} ?>
									</td>
									<td style="text-align: center; padding-left: 7px;">
										<?php if($newproduct->onlyInPackage){echo '<i style="color: #0a0; font-size: 18px; font-weight: normal;" class="fa fa-delicious" title="Csak csomagban érhető el!"></i>';}else{echo '&nbsp;';} ?>
									</td>
									<td style="text-align: left; font-weight: bold; padding-left: 7px;"><?= h($newproduct->name) ?></td>
									<td style="text-align: center; font-weight: bold; padding-left: 7px;"><?= $newproduct->pkg_catv_id ?></td>
									<td style="text-align: center; font-weight: bold; padding-left: 7px;"><?= $newproduct->pkg_net_id ?></td>
									<td style="text-align: center; font-weight: bold; padding-left: 7px;"><?= $newproduct->pkg_tel_id ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= substr($servicegroups[$newproduct->servicegroup],0,30) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= $newproduct->szla_headstation->name ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($newproduct->price) ?> Ft</td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($newproduct->pos) ?></td>
									<td style="text-align: center; padding-left: 7px;">
										<?php if($newproduct->visible){echo '<i style="color: #0a0; font-weight: normal;" class="fa fa-eye"></i>';}else{echo '<i style="color: #faa; font-weight: normal;" class="fa fa-eye"></i>';} ?>
									</td>

									<td style="text-align: center;"><?= $this->Time->format( $newproduct->created, 'yyyy.MM.dd. HH:mm:ss', null, $newproduct->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $newproduct->modified, 'yyyy.MM.dd. HH:mm:ss', null, $newproduct->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $newproduct->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $newproduct->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $newproduct->id)]) ?>
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
