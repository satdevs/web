
<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="cities_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="cities" role="grid" id="cities" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 100px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" aria-sort="ascending" class="sorting_asc">Műsor<span style="color: red;">(EXT-1!)</span></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('irsz','Ir.sz.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 120px; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px;" aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone_area','Tel.körz.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px;" aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('ksh_kod','KSH kód') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('headstation_id','Fejállomás') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($cities as $city): ?> 
								<tr row-id="<?= $city->id ?>">
									<td style="text-align: center; padding-right: 7px;">
										<a href="http://www.saghysat.hu/channels/packages/generate_channels_to_pdf/1.pdf">PDF</a> - 
										<a href="http://www.saghysat.hu/channels/packages/generate_channels_to_pdf/1">HTML</a>
									</td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($city->id) ?></td>
									<td style="text-align: center; padding-left: 7px;"><?= h($city->irsz) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($city->name) ?></td>
									<td style="text-align: center; padding-left: 7px;"><?= h($city->phone_area) ?></td>
									<td style="text-align: center; padding-left: 7px;"><?= h($city->ksh_kod) ?></td>
									<td style="text-align: left; padding-right: 7px;"><?= h($city->szla_headstation->name) ?></td>
									<td style="text-align: center;">
										<?php //= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $city->id], ['escape' => false]) ?>&nbsp;&nbsp;
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" aria-sort="ascending" class="sorting_asc">Műsor</th>
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('irsz','Ir.sz.') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','Neve') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('phone_area','Tel.körz.') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('ksh_kod','KSH kód') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0" class="sorting"><?= $this->Paginator->sort('headstation_id','Fejállomás') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="cities" tabindex="0">Műveletek</th>
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
