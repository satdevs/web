<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/subs/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új felvitele</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_subs', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="subs_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="subs" role="grid" id="subs" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name2','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('city_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('kerulet','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('street_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('HSZ','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('hazszam','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('epulet','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('lepcsohaz','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szint','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('ajto','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('hrsz','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('TIPUS','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('FIZMOD','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('anyanev','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szulhely','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szulido','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szigszam','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('adoszam','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('cegszam','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('TEL','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('EMAIL','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('BANKSZLA','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('bank_id','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('NYITOFT','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('SZERZDAT','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('AKTIV','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('IKULCS','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('ft_status','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('tipus2','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szla_kezbesites','') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('HSZ_TMP','') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($subs as $sub): ?> 
								<tr row-id="<?= $sub->id ?>">
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->name) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->name2) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->city_id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->kerulet) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->street_id) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->HSZ) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->hazszam) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->epulet) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->lepcsohaz) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->szint) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->ajto) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->hrsz) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->TIPUS) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->FIZMOD) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->anyanev) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->szulhely) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->szulido) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->szigszam) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->adoszam) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->cegszam) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->TEL) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->EMAIL) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->BANKSZLA) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->bank_id) ?></td>
									<td style="text-align: right; padding-right: 7px;"><?= $this->Number->format($sub->NYITOFT) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->SZERZDAT) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->AKTIV) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->IKULCS) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->ft_status) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->tipus2) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->szla_kezbesites) ?></td>
									<td style="text-align: left; padding-left: 7px;"><?= h($sub->HSZ_TMP) ?></td>

									<td style="text-align: center;"><?= $this->Time->format( $sub->created, 'yyyy.MM.dd. HH:mm:ss', null, $sub->time_zone ); ?></td>
									<td style="text-align: center;"><?= $this->Time->format( $sub->modified, 'yyyy.MM.dd. HH:mm:ss', null, $sub->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $sub->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $sub->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $sub->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $sub->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr role="row">
									<th style="border-top: 2px solid lightgray; width: 40px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('name2','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('city_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('kerulet','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('street_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('HSZ','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('hazszam','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('epulet','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('lepcsohaz','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szint','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('ajto','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('hrsz','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('TIPUS','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('FIZMOD','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('anyanev','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szulhely','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szulido','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szigszam','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('adoszam','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('cegszam','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('TEL','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('EMAIL','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('BANKSZLA','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('bank_id','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('NYITOFT','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('SZERZDAT','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('AKTIV','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('IKULCS','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('ft_status','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('tipus2','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('szla_kezbesites','') ?></th>
									<th style="border-top: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('HSZ_TMP','') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-top: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0" class="sorting"><?= $this->Paginator->sort('modified','Módosítva') ?></th>
									<th style="border-top: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="subs" tabindex="0">Műveletek</th>
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
