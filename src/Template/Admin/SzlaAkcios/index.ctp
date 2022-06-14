<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="akcios_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="akcios" role="grid" id="akcios" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('focikk','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('cikk','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('akcios_kedv','Akc.kedv.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('duo_kedv','Duo.kedv.') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 80px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('trio_kedv','Trio.kedv.') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($akcios as $akcio): ?> 
								<tr row-id="<?= $akcio->id ?>">
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($akcio->id) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($akcio->focikk) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($akcio->cikk) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($akcio->akcios_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($akcio->duo_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($akcio->trio_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: center;">&nbsp;</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('focikk','Fő cikk') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('cikk','Cikk') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('akcios_kedv','Akc.') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('duo_kedv','Duó.kedv.') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0" class="sorting"><?= $this->Paginator->sort('trio_kedv','Trió.kedv.') ?></th>
									<th style="border-top: 2px solid lightgray; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="akcios" tabindex="0">&nbsp;</th>
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
