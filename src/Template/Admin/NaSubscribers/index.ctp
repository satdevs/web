<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/subscribers/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_subscribers', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="subscribers_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="subscribers" role="grid" id="subscribers" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('radius_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('ext_key','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('fullname','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('city','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('zip','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('street','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('address','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel1','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel2','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('paymode','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('category','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('over_limit_down','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('over_limit_up','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('contract_time','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('contract_year','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('download_override','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('upload_override','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('last_change','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('size_override','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('debug','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('category_test','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($subscribers as $subscriber): ?> 
								<tr row-id="<?= $subscriber->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->id) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->radius_id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->ext_key) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->fullname) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->city) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->zip) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->street) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->address) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->tel1) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->tel2) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->paymode) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->category) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->over_limit_down) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->over_limit_up) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->contract_time) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->contract_year) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->download_override) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->upload_override) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->last_change) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($subscriber->size_override) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->debug) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($subscriber->category_test) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $subscriber->created, 'yyyy.MM.dd. HH:mm:ss', null, $subscriber->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $subscriber->modified, 'yyyy.MM.dd. HH:mm:ss', null, $subscriber->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $subscriber->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $subscriber->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $subscriber->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $subscriber->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('radius_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('ext_key','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('fullname','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('city','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('zip','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('street','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('address','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel1','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('tel2','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('paymode','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('category','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('over_limit_down','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('over_limit_up','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('contract_time','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('contract_year','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('download_override','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('upload_override','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('last_change','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('size_override','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('debug','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('category_test','') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subscribers" tabindex="0">Műveletek</th>
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
