<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="internetextras_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="internetextras" role="grid" id="internetextras" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Név') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('custno','Ügyfélszám') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('email','E-mail') ?></th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting">
										<?= $this->Paginator->sort('city','Település') ?>,
										<?= $this->Paginator->sort('address','Cím') ?>
									</th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('accept','Igényelve') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('cb5','Adatkezelés') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="internetextras" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($internetextras as $internetextra): ?> 
								<tr row-id="<?= $internetextra->id ?>">
									<td style="text-align: left; padding-left: 7px;"><b><?= h($internetextra->name) ?></b></td>
									<td style="text-align: left; padding-left: 7px; font-size: 18px;"><b><?= h($internetextra->custno) ?></b></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($internetextra->email) ?></td>
									<td style="text-align: left; padding-left: 7px;">
										<b><?= h($internetextra->city) ?></b>,
										<?= h($internetextra->address) ?>
									</td>
									
									<td style="text-align: center;"><b><?php if($internetextra->accept){echo "X";}else{echo "&nbsp;";} ?></b></td>
									<td style="text-align: center;"><b><?php if($internetextra->cb5){echo "X";}else{echo "&nbsp;";} ?></b></td>
									
									<td style="text-align: center;"><?= $this->Time->format( $internetextra->created, 'yyyy.MM.dd. HH:mm:ss', null, $internetextra->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $internetextra->modified, 'yyyy.MM.dd. HH:mm:ss', null, $internetextra->time_zone ); ?></td>
									<td style="text-align: center;">
										<?php //= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $internetextra->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $internetextra->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?php echo $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $internetextra->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $internetextra->id)]) ?>
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
