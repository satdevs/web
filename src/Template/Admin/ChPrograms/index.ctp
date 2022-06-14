<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/programs/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
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
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_programs', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>

	</div>
</div>
*/ ?>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="programs_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="programs" role="grid" id="programs" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 60px; " aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('logo_url','Logo') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 200px;" aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 150px;" aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('language','Nyelv') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('feature_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 100px; " aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('packages_program_count','Számosság') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="programs" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($programs as $program): ?> 
								<tr row-id="<?= $program->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($program->id) ?></td>
									<td style="text-align: center; padding-left: 7px;">
<?php if($program->logo_file!=Null && file_exists(WWW_ROOT."images".DS."logo".DS.$program->logo_file)){ ?>
										<img src="/images/logo/<?= $program->logo_file ?>" style="height: 20px; max-width: 300px;">
<?php }else{ ?>
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $program->id], ['escape' => false, 'title'=>'Szerkesztés']) ?>&nbsp;&nbsp;
<?php } ?>
									</td>
									<td style="text-align: left; padding-left: 7px;"><?= h($program->name) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($program->language) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= h($program->ch_feature->name) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($program->packages_program_count) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $program->modified, 'yyyy.MM.dd. HH:mm:ss', null, $program->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $program->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?php //= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $program->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $program->id)]) ?>
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
