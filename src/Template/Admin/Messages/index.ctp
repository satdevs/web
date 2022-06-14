<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/messages/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Üzenet témák</button>'), ['controller' => 'Messagethemes', 'action' => 'index'], ['escape' => false]) ?>
		<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új üzenet téma</button>'), ['controller' => 'Messagethemes', 'action' => 'add'], ['escape' => false]) ?>
	</div>
</div>

<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline dt-bootstrap" id="example2_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="messages" role="grid" id="example2" class="table table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<!--th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('messagetheme_id','Téma') ?></th-->
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('subject','Tárgy') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 150px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($messages as $message): ?> 
<?php $style=""; if($message->readed==0){$style=' style="font-weight: bold;"';} ?> 
	
								<tr row-id="<?= $message->id ?>"<?= $style ?>>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($message->id) ?></td>
									<!--td style="text-align: left; padding-right: 7px;"><?= $message->has('messagetheme') ? $this->Html->link($message->messagetheme->name, ['controller' => 'Messagethemes', 'action' => 'view', $message->messagetheme->id]) : '' ?></td-->
									<td style="text-align: left; padding-left: 7px;"><?= h($message->name) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($message->subject) ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $message->created, 'yyyy.MM.dd. HH:mm:ss', null, $message->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $message->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $message->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $message->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $message->id)]) ?>
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
