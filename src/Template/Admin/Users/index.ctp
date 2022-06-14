<div class="box">
	<div class="box-body">
		<div class="col-sm-10">
			<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új</button>'), ['action' => 'add'], ['escape' => false]) ?>

			<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Csoportok</button>'), ['controller' => 'Groups', 'action' => 'index'], ['escape' => false]) ?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új csoport</button>'), ['controller' => 'Groups', 'action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
<?php /*
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: -10px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'export_to_excel', '_ext' => 'xlsx'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>
	</div>
</div>



<div class="box" id="users">
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
					<table aria-describedby="users" role="grid" id="example2" class="table table-striped table-bordered table-hover dataTable">
						<thead>
							<tr role="row">
								<th style="border-bottom: 2px solid lightgray; width: 150px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('group_id','Csoport') ?></th>
								<th style="border-bottom: 2px solid lightgray; width: 250px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
	 							<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('email','Email') ?></th>
<?php
/*
								<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0">Export</th>
*/
?>

								<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
								<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
								<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0">Műveletek</th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user): ?>
							<tr class="odd" role="row">
								<td style="text-align: left;"><?= $user->has('group') ? $this->Html->link($user->group->name, ['controller' => 'Groups', 'action' => 'view', $user->group->id]) : '' ?></td>
								<td style="text-align: left;">
								<img src="/images/uploads/users/<?= h($user->id) ?>.<?= h($user->avatar_ext) ?>" alt="<?= h($user->name) ?>" class="user-image" />
									<?= h($user->name) ?>
								</td>
								<td style="text-align: left;"><?= h($user->email) ?></td>
<?php
/*
								<td style="text-align: center;">
									<?= $this->Html->link(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'view', $user->id, '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
								</td>
*/
?>
								<td style="text-align: center;"><?= $this->Time->format( $user->created, 'yyyy.MM.dd. HH:mm:ss', null, $user->time_zone ); ?></td>
								<td style="text-align: center;"><?= $this->Time->format( $user->modified, 'yyyy.MM.dd. HH:mm:ss', null, $user->time_zone ); ?></td>
								<td style="text-align: center;">
									<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $user->id], ['escape' => false]) ?>&nbsp;&nbsp;
									<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $user->id], ['escape' => false]) ?>&nbsp;&nbsp;
									<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th style="border-top: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('group_id','Csoport') ?></th>
								<th style="border-top: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
								<th style="border-top: 2px solid lightgray;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('email','Email') ?></th>
<?php /*
								<th style="border-top: 2px solid lightgray; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0">Export</th>
*/ ?>
								<th style="border-top: 2px solid lightgray; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
								<th style="border-top: 2px solid lightgray; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
								<th style="border-top: 2px solid lightgray; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="example2" tabindex="0">Műveletek</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-5">
					<div aria-live="polite" role="status" id="users" class="dataTables_info">
						<?= $this->Paginator->counter([
						    'format' => '{{page}} / {{pages}} oldal. Mutat: {{current}} / {{count}} sor.&nbsp;&nbsp;&nbsp;&nbsp; {{start}}..{{end}}'
						]) ?>						
					</div>
				</div>

				<div class="col-sm-7">
					<div id="example2_paginate" class="paginator dataTables_paginate paging_simple_numbers">
						<ul class="pagination">
							<?= $this->Paginator->first('<i class="fa fa-fw fa-angle-double-left"></i> ',['escape'=>false]) ?>
							<?= $this->Paginator->prev('<i class="fa fa-fw fa-angle-left"></i> ',['escape'=>false]) ?>
							<?= $this->Paginator->numbers() ?>
							<?= $this->Paginator->next('<i class="fa fa-fw fa-angle-right"></i> ',['escape'=>false]) ?>
							<?= $this->Paginator->last('<i class="fa fa-fw fa-angle-double-right"></i> ',['escape'=>false]) ?>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
