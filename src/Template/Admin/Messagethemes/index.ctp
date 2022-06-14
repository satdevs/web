<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/messagethemes/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Üzenetek</button>'), ['controller' => 'Messages', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új üzenet</button>'), ['controller' => 'Messages', 'action' => 'add'], ['escape' => false]) ?>
	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="messagethemes_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="messagethemes" role="grid" id="messagethemes" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Rang') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($messagethemes as $messagetheme): ?> 
								<tr row-id="<?= $messagetheme->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($messagetheme->id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($messagetheme->name) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($messagetheme->pos) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $messagetheme->created, 'yyyy.MM.dd. HH:mm:ss', null, $messagetheme->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $messagetheme->modified, 'yyyy.MM.dd. HH:mm:ss', null, $messagetheme->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $messagetheme->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $messagetheme->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $messagetheme->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $messagetheme->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: left;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('pos','Rang') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="messagethemes" tabindex="0">Műveletek</th>
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
