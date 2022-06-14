<?php
	$services = [0=>'---', 1=>'Kábel TV', 2=>'Internet'];
?>
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>

        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($dependency,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">TEL:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('tel_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
                <div class="col-sm-2">
					<label for="catv_id" class="col-sm-1 control-label">KTV:</label>
					<div class="col-sm-1">
						<?php echo $this->Form->checkbox('catv_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
                </div>
                <div class="col-sm-2">
					<label for="net_id" class="col-sm-1 control-label">NET:</label>
					<div class="col-sm-1">
						<?php echo $this->Form->checkbox('net_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
					</div>
                </div>
            </div>            
            <!--div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">KTV:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('catv_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">NET:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('net_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div-->
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/dependencies/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
