			<div class="row">
				<div class="col-sm-5">
				</div>
				<div class="col-sm-7">
					<div aria-live="polite" role="status" id="users" class="dataTables_info" style="float: right;">
						<?= $this->Paginator->counter([
							'format' => '{{page}} / {{pages}} oldal. Mutat: {{current}} / {{count}} sor.&nbsp;&nbsp;&nbsp;&nbsp; {{start}}..{{end}}'
						]) ?>                       
					</div>
					<div id="paginate" class="paginator dataTables_paginate paging_simple_numbers">
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
