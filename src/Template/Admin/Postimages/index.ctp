<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
			<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új fotó(k) feltöltése</button>'), ['action' => 'add'], ['escape' => false]) ?>
<?php if($current==1){ ?>
			<?= $this->Html->link(__('<button type="button" class="btn btn-warning">Összes jelölt (flag) törlése</button>'), ['action' => 'setAllCurrentOff'], ['escape' => false, 'confirm' => __('Valóban be szeretnéd állítani a jelölőt 0-ra?')]) ?>
<?php } ?>
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_postimages', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
<?php /*
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
*/ ?>
		</div>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="postimages_wrapper">
			<div class="row">
				<div class="col-sm-6">
					<?php if($current==1){$buttontype='info';}else{$buttontype='default';} ?>
					<?= $this->Html->link(__('<button type="button" class="btn btn-'.$buttontype.'">Jelölt képek mutatása</button>'), ['action' => 'index',1], ['escape' => false]) ?>
					<?php if($current==0){$buttontype='info';}else{$buttontype='default';} ?>
					<?= $this->Html->link(__('<button type="button" class="btn btn-'.$buttontype.'">Jelöletlen képek mutatása</button>'), ['action' => 'index',0], ['escape' => false]) ?>
					<?php if($current==2){$buttontype='info';}else{$buttontype='default';} ?>
					<?= $this->Html->link(__('<button type="button" class="btn btn-'.$buttontype.'">Összes kép mutatása</button>'), ['action' => 'index',2], ['escape' => false]) ?>
				</div>
				<div class="col-sm-6">
				</div>
			</div>

<!-- Gallery - START -->

<div class="container">
    <div class="row">
        <div class="text-center">
            <h1>Képek</h1>
        </div>
        <div class="row">

<?php $tabindex=1;
	foreach ($postimages as $postimage): ?> 

            <div class="col-md-3">
                <div class="well" style="height: 230px; position: relative;">
					<div style="height: 140px; overflow: hidden; margin-bottom: 16px; border: 1px solid lightgray; padding: 4px; padding-bottom: 5px;">
						<div class="thumbnail" style="background: #fff; height: 130px; width: 220px; margin: 0px; padding: 0px; border: 0px solid red; overflow: hidden;">
                    		<img style="width: 100%" src="/images/uploads/postimages/<?= $this->Number->format($postimage->id) ?>_thumb.jpg" class="img-responsive" alt="<?= $this->Number->format($postimage->title) ?>" />
                    	</div>
					</div>
					<?= $this->Form->create($postimage,['class'=>'form-horizontal', 'enctype'=>'multipart/form-data', 'form-id'=>$postimage->id ]) ?>
						<?php echo $this->Form->input('title', ['title-id'=>$postimage->id, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'value'=>$postimage->title, 'style'=>'width: 100%;', 'name'=>'postimage-title', 'tabindex'=>$tabindex++ ]); ?>
					<?= $this->Form->end() ?>                
					<?php if($postimage->current==0){$color="red"; $icon="fa-eye-slash";}else{$color="green"; $icon="fa-eye";} ?>
					<?= $this->Html->link(__('<i eye-icon-id="'.$postimage->id.'" style="font-size: 28px; color: '.$color.';" class="fa fa-fw fa-eye-slash"></i>'), ['action' => 'changeFlag', $postimage->id, $current ], ['escape' => false, 'style'=>'position: absolute; bottom: 22px; right: 20px;', 'class'=>'eye', 'eye-id'=>$postimage->id, 'onclick'=>'javasript:return(false);','title'=>'Láthatóság ki/be kapcsolása']) ?>&nbsp;&nbsp;

                </div>
            </div>

<?php endforeach; ?>

        </div>



    </div>
</div>
<!-- Gallery - END -->




<?php /*
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="postimages" role="grid" id="postimages" class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="postimages" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray;  " aria-label="" colspan="1" rowspan="1" aria-controls="postimages" tabindex="0" class="sorting"><?= $this->Paginator->sort('title','Cím') ?>
										&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: gray;"><i>(A beviteli mezőből való kilépéssel mentődik a cím. Ne felejts el kilépni az utolsó mezőből ;-)</i></span>
									</th>
									<th style="border-bottom: 2px solid lightgray; width: 140px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="postimages" tabindex="0" class="sorting"><?= $this->Paginator->sort('created','Készült') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="postimages" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php $tabindex=1;
	foreach ($postimages as $postimage): ?> 
								<tr row-id="<?= $postimage->id ?>">
									<td style="text-align: left; padding-left: 7px;">
										<div style="height: 70px; width: 100px; overflow: hidden; background: gray; border: 3px solid gray;">
											<img style="width: 94px" src="/images/uploads/postimages/<?= $this->Number->format($postimage->id) ?>_thumb.jpg" alt="<?= $this->Number->format($postimage->title) ?>" />
										</div>
									</td>
									<td style="text-align: left; padding-left: 7px;">
    									<?= $this->Form->create($postimage,['class'=>'form-horizontal', 'enctype'=>'multipart/form-data', 'form-id'=>$postimage->id ]) ?>
											<?php echo $this->Form->input('title', ['title-id'=>$postimage->id, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'value'=>$postimage->title, 'style'=>'width: 80%;', 'name'=>'postimage-title', 'tabindex'=>$tabindex++ ]); ?>
											<!--a class='btn btn-success' style='margin-top: 3px;' id="<?= $postimage->id ?>" >
												<i class="fa fa-fw fa-save"></i> Mentés
											</a-->
										<?= $this->Form->end() ?>
										<?php if($postimage->current==0){$color="red"; $icon="fa-eye-slash";}else{$color="green"; $icon="fa-eye";} ?>
										<?= $this->Html->link(__('<i style="font-size: 28px; color: '.$color.';" class="fa fa-fw fa-eye-slash"></i>'), ['action' => 'changeFlag', $postimage->id, $current ], ['escape' => false]) ?>&nbsp;&nbsp;
									</td>

									<td style="text-align: center;"><?= $this->Time->format( $postimage->created, 'yyyy.MM.dd. HH:mm:ss', null, $postimage->time_zone ); ?></td>
									<td style="text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 18px;" class="fa fa-fw fa-eye"></i>'), ['action' => 'view', $postimage->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $postimage->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $postimage->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $postimage->id)]) ?>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
*/ ?>





<?= $this->element('paginator'); ?>

		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- ------------------------------------------------- /index ------------------------------------------------- -->
