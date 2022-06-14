
<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="dhcpLeasesLast_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="dhcpLeasesLast" role="grid" id="dhcpLeasesLast" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('date','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('lease_time','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('modem','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpemac','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpeip','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_id','CpeId') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_name','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_addr','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($dhcpLeasesLast as $dhcpLeasesLast): ?> 
								<tr row-id="<?= $dhcpLeasesLast->cpe_id ?>">
									<td style="text-align: center;"><?= $this->Time->format( $dhcpLeasesLast->date, 'yyyy.MM.dd. HH:mm:ss', null); ?></td>

									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->lease_time) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->modem) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->cpemac) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->cpeip) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->cpe_id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->cpe_name) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($dhcpLeasesLast->cpe_addr) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $dhcpLeasesLast->created, 'yyyy.MM.dd. HH:mm:ss', null, $dhcpLeasesLast->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $dhcpLeasesLast->modified, 'yyyy.MM.dd. HH:mm:ss', null, $dhcpLeasesLast->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $dhcpLeasesLast->cpe_id], ['escape' => false]) ?>&nbsp;&nbsp;
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('date','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('lease_time','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('modem','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpemac','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpeip','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_id','CpeId') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_name','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('cpe_addr','') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="dhcpLeasesLast" tabindex="0">Műveletek</th>
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
