<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/uploads/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_uploads', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="uploads_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="uploads" role="grid" id="uploads" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 90px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('servicegroup','Szolg.cs.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('pos','Poz.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 95px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('date_from','Dátumtól') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 30px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('show_in_mainpage','MainPG') ?></th>

									<th style="border-bottom: 2px solid lightgray; width: 60px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" aria-sort="ascending" class="sorting_asc" title="Hatályos"><?= $this->Paginator->sort('current','Cur.') ?></th>
									
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Címe') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" class="sorting"><?= $this->Paginator->sort('filename','File neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" class="sorting"><?= $this->Paginator->sort('visible','Láth') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="uploads" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($uploads as $upload): ?> 
								<tr row-id="<?= $upload->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($upload->id) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($upload->servicegroup) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($upload->pos) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= h($upload->date_from) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?php
										if($upload->show_in_mainpage){
											echo '<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>';
										}else{
											echo '&nbsp;';
										}										
									?></td>
									
									<td style="text-align: center;">
										<?php 
											if($upload->current == 1):
												echo "X";
											else:
												echo "-";
											endif;
										?>
									</td>
									
									
									<td style="text-align: left; padding-left: 7px;">
										<a href="/download/<?= $upload->hash ?>"><?= h($upload->name) ?></a>
										<?php //<br>/download/<?= h($upload->hash) ?>
									</td>
									<td style="text-align: left; padding-left: 7px;">
										<a href="/download/<?= $upload->hash ?>"><?= h($upload->filename) ?></a>
									</td>
									<td style="text-align: center;">
										<?= h($upload->visible) ?>
									</td>
									<td style="text-align: center;"><?= $this->Time->format( $upload->modified, 'yyyy.MM.dd. HH:mm:ss', null, $upload->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $upload->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $upload->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $upload->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $upload->id)]) ?>
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
