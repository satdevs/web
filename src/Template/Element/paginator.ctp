<?php if($this->Paginator->numbers()){ ?>
<div class="row">
	<div class="col-sm-12">
		<nav>
		  <ul class="pager">
		    <?= $this->Paginator->prev('<i class="fa fa-fw fa-arrow-left"></i> előző oldal',['escape'=>false], ['class'=>'previous']) ?>

			<?= $this->Paginator->numbers() ?>

		    <?= $this->Paginator->next('következő oldal <i class="fa fa-fw fa-arrow-right"></i>',['escape'=>false, 'class'=>'next']) ?>
		  </ul>
		</nav>
<?php /*
		<div id="paginate" class="paginator" style="padding: 0px; margin: 0px; height: 32px;">
			<ul class="pagination pagination-lg" style="padding: 0px; margin: 0px;">
				<?php //= $this->Paginator->first('<i class="fa fa-fw fa-angle-double-left"></i> első oldal',['escape'=>false]) ?>
				<?= $this->Paginator->prev('<i class="fa fa-fw fa-arrow-left"></i> előző oldal',['escape'=>false]) ?>
				<?= $this->Paginator->prev('<i class="fa fa-fw fa-arrow-left"></i> előző oldal',['escape'=>false]) ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next('következő oldal <i class="fa fa-fw fa-arrow-right"></i>',['escape'=>false]) ?>
				<?php //= $this->Paginator->last('utolsó oldal <i class="fa fa-fw fa-angle-double-right"></i> ',['escape'=>false]) ?>
			</ul>
		</div>
*/ ?>
	</div>
</div>
<?php /*
                <ul class="pagination pagination-lg">
                    <li><a href="#"><i class="fa fa-arrow-left"></i></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-arrow-right"></i></a></li>
                </ul>
*/ ?>
<?php } ?>