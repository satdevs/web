<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="products_wrapper">
			<div class="row">
				<div class="col-sm-6">
					<h3>
						<a href="/admin/szla_products">Összes</a> |
						<a href="/admin/szla_products/index/64.20.16">64.20.16</a> |
						<a href="/admin/szla_products/index/64.20.18">64.20.18</a> |
						<a href="/admin/szla_products/index/64.20.30">64.20.30</a> |
						<a href="/admin/szla_products/index/64.20.31">64.20.31</a>
					</h3>
					Csak a staus = 1 rekordok jelennek meg
				</div>
				<div class="col-sm-6">

				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="products" role="grid" id="products" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('cikk','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('csoport','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('nev','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('itj','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('afa','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('me','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  text-align: center;" aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('ft','Ft') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('status','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('ext_package','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('duo_kedv','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('trio_kedv','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('netfone_package','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('akcios_kedv','') ?></th>
									<!--th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0">Műveletek</th-->
								</tr>
							</thead>
							<tbody>
<?php foreach ($products as $product): ?> 
								<tr row-id="<?= $product->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($product->id) ?></td>
									<td style="text-align: center; padding-left: 7px;"><?= h($product->cikk) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->format($product->csoport) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($product->nev) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($product->itj) ?></td>
									<td style="text-align: center; padding-right: 7px;"><?= $this->Number->toPercentage($product->afa,0) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($product->me) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($product->ft,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($product->status) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($product->ext_package) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($product->duo_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($product->trio_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<td style="text-align: right; padding-left: 7px;"><?= h($product->netfone_package) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($product->akcios_kedv,['places' => 0,'locale' => 'hu_HU','after' => ' Ft']) ?></td>
									<!--td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $product->id], ['escape' => false]) ?>&nbsp;&nbsp;
									</td-->
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('cikk','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('csoport','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('nev','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('itj','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('afa','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('me','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('ft','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('status','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('ext_package','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('duo_kedv','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('trio_kedv','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('netfone_package','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0" class="sorting"><?= $this->Paginator->sort('akcios_kedv','') ?></th>
									<!--th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="products" tabindex="0">Műveletek</th-->
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
