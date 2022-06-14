				<div class="widget search">
					<?= $this->Form->create($posts,['class'=>'form-horizontal']) ?>
						<div class="input-group">
							<?= $this->Form->input('search', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'Keresés', 'autocomplete'=>'off', 'type'=>'text', 'autofocus'=>false]); ?>
							<span class="input-group-btn">
								<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
								<?php //= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
							</span>
						</div>
					<?= $this->Form->end() ?>
				</div><!--/.search-->


<?php /*
				----------- SRC BACKUP ------------
				<div class="widget search">
					<form role="form">
						<div class="input-group">
							<input type="text" class="form-control" autocomplete="off" placeholder="Keresés">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
				</div><!--/.search-->
*/ ?>
