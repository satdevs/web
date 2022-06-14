<?php
	$page = $this->Paginator->counter(['format' => '{{page}}']);
?>
<!-- ------------------------------------------------- index ------------------------------------------------- -->
<script>
	$(document).ready( function(){
		$("tr").dblclick( function(){
			window.location.href = "<?php if($admin){echo "/admin";}?>/posts/edit/"+$(this).attr('row-id')+"/"+<?php echo $page; ?>;
		});
	});
</script>

<div class="box">
	<div class="box-body">
		<div class="col-sm-10">	
		<?= $this->Html->link(__('<button type="button" class="btn btn-success">Új cikk</button>'), ['action' => 'add'], ['escape' => false]) ?>
		</div>
<?php /*
		<div class="col-sm-2 text-right" style="padding-top: 5px; padding-bottom: 0px;">
			<?= $this->Html->link(__('<img src="/img/csv.png" style="height: 22px; margin-top: 0px;" title="Összes rekord exportálása CSV-be" />'), ['action' => 'export_to_csv','export_posts', '_ext' => 'csv'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: green;" class="fa fa-fw fa-file-excel-o"></i>'), ['action' => 'index', '_ext' => 'xls'], ['escape' => false]); ?>&nbsp;&nbsp;
			<?= $this->Html->link(__('<i style="font-size: 22px; color: red;" class="fa fa-fw fa-file-pdf-o"></i>'), ['action' => 'index', '_ext' => 'pdf'], ['escape' => false]); ?>&nbsp;&nbsp;
		</div>
*/ ?>

	</div>
</div>


<div class="box">
	<div class="box-body">
		<div class="dataTables_wrapper form-inline table-striped dt-bootstrap" id="posts_wrapper">
			<div class="row">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table aria-describedby="posts" role="grid" id="posts" class="table table-striped table-bordered table-hover dataTable">
							<thead>
								<tr role="row">
									<th style="border-bottom: 2px solid lightgray; width: 50px; text-align: center; " aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('id','#id') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 120px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" class="sorting"><?= $this->Paginator->sort('date_from','Publikálva') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 90px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" class="sorting"><?= $this->Paginator->sort('visible_start','-tól') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 90px; text-align: center; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" class="sorting"><?= $this->Paginator->sort('visible_end','-ig') ?></th>
									<th style="border-bottom: 2px solid lightgray; text-align: left; " aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" aria-sort="ascending" class="sorting_asc"><?= $this->Paginator->sort('postcategory_id','Kategória') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 70px; text-align: center; ">Kép</th>
									<th style="border-bottom: 2px solid lightgray; " aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0" class="sorting"><?= $this->Paginator->sort('title','Cím') ?></th>
									<th style="border-bottom: 2px solid lightgray; width: 110px; text-align: left; padding-left: 10px;" aria-label="" colspan="1" rowspan="1" aria-controls="posts" tabindex="0">Műveletek</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($posts as $post): 
	// debug( $post->toArray() ); die();
?>
								<tr row-id="<?= $post->id ?>">
									<td style="vertical-align: middle; text-align: right; padding-right: 7px;"><?= $this->Number->format($post->id) ?></td>
									<td style="vertical-align: middle; text-align: center;"><?= $this->Time->format( $post->date_from, 'yyyy.MM.dd. HH:mm', null, $post->time_zone ); ?></td>
									<td style="vertical-align: middle; text-align: center;"><?= $this->Time->format( $post->visible_start, 'yyyy.MM.dd.', null, $post->time_zone ); ?></td>
									<td style="vertical-align: middle; text-align: center;"><?= $this->Time->format( $post->visible_end, 'yyyy.MM.dd.', null, $post->time_zone ); ?></td>
									<td style="vertical-align: middle; text-align: left; padding-left: 7px;"><?= $post->postcategory->title ?></td>
									<td style="vertical-align: middle; text-align: center; padding-right: 7px;">
<?php if($post->no_img == 0){ ?>
									<?php if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$post->id.'_thumb.jpg')){ ?>
										<img src="/images/uploads/posts/<?= $this->Number->format($post->id) ?>_thumb.jpg" height="40" />
									<?php }else{ ?>
										<img src="/img/no-image.jpg" height="40" />
									<?php } ?>
<?php }else{ ?>										
									---
<?php } ?>										
									</td>
									<td style="vertical-align: middle; text-align: left; padding-left: 7px; font-weight: bold;">
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $post->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= h($post->title) ?>
									</td>
									<td style="vertical-align: middle; text-align: center;">
										<?= $this->Html->link(__('<i style="font-size: 16px;" class="fa fa-fw fa-edit"></i>'), ['action' => 'edit', $post->id], ['escape' => false]) ?>&nbsp;&nbsp;
										<?= $this->Form->postLink(__('<i style="font-size: 18px; color: red;" class="fa fa-fw fa-remove"></i>'), ['action' => 'delete', $post->id], ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd a rekordot: #{0}?', $post->id)]) ?>
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
